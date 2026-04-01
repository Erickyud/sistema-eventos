<?php
session_start();


include("../config/conexao.php");
include("header.php");

$id_grupo = $_GET['id_grupo'] ?? 0;
$usuario_id = $_SESSION['usuario_id'];

$verifica = mysqli_query($conexao, "
    SELECT * FROM grupo_usuarios 
    WHERE id_usuario = $usuario_id AND id_grupo = $id_grupo
");

$grupo = mysqli_fetch_assoc(mysqli_query($conexao, 
    "SELECT * FROM grupo_eventos WHERE id = $id_grupo"
));

if(mysqli_num_rows($verifica) == 0){
    header("Location: tela_principal.php");
    exit;
}

if($id_grupo == 0){
    echo "Erro: grupo não informado.";
    exit;
}

?>

<div class="voltar-container">
    <a href="tela_principal.php" class="btn-voltar">← Voltar</a>
</div>

<div class="grupo-container">

    <!-- CHAT -->
    <div class="chat-box">
        <div class="topo-grupo">
            <div class="titulo-grupo">
                <h2><?php echo $grupo['nome']; ?></h2>
                <span>Código: <?php echo $grupo['codigo']; ?></span>
            </div>

                <div class="menu-opcoes">
                <button onclick="toggleMenu()" class="btn-menu">⋮</button>

                <div id="menu-box" class="menu-box">

                <!-- SÓ ADMIN -->
                <?php if($grupo['criador_id'] == $usuario_id){ ?>
                    <a href="javascript:void(0)" onclick="confirmarExclusao(<?php echo $id_grupo; ?>)">
                        🗑 Excluir Grupo
                    </a>
                <?php } ?>

                <!-- TODOS -->
                <a href="javascript:void(0)" onclick="confirmarSaida(<?php echo $id_grupo; ?>)">
                    🚪 Sair do Grupo
                </a>

                </div>
            </div>
    </div>

        <button onclick="toggleParticipantes()" class="btn">
            👥 Ver Participantes
        </button>

        <div id="participantes-box" class="participantes-box" style="display:none;">
            <h3>Participantes</h3>

            <?php
            $usuarios = mysqli_query($conexao, "
                SELECT u.* FROM usuarios u
                JOIN grupo_usuarios gu ON gu.id_usuario = u.id
                WHERE gu.id_grupo = $id_grupo
            ");

            while($u = mysqli_fetch_assoc($usuarios)){

            if($u['id'] == $grupo['criador_id']){
                echo "<p>👑 " . $u['nome'] . " (Admin)</p>";
            } else {
                echo "<p>👤 " . $u['nome'] . "</p>";
            }

}
            ?>
        </div>

        <div class="chat-mensagens" id="chat"></div>

        <form class="chat-form" onsubmit="enviarMensagem(event)">
            <input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>">
            <input type="text" name="mensagem" placeholder="Digite uma mensagem..." required>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- EVENTOS -->
    <div class="eventos-box">
        <h3>Eventos</h3>

        <div id="eventos"></div>

        <a href="criar_evento.php?id_grupo=<?php echo $id_grupo; ?>" class="btn">
            + Criar Evento
        </a>
    </div>
</div>

</main>

<script>
let abasAbertas = {};
</script>

<!-- CHAT -->
<script>
function atualizarChat() {
    fetch('../acoes/buscar_mensagens.php?id_grupo=<?php echo $id_grupo; ?>')
    .then(response => response.text())
    .then(data => {
        var chat = document.getElementById("chat");

        let estaNoFinal = chat.scrollTop + chat.clientHeight >= chat.scrollHeight - 50;

        chat.innerHTML = data;

        if (estaNoFinal) {
            chat.scrollTop = chat.scrollHeight;
        }
    });
}

atualizarChat();
setInterval(atualizarChat, 2000);
</script>

<script>
function enviarMensagem(event) {
    event.preventDefault(); 

    var form = event.target;
    var formData = new FormData(form);

    fetch('../acoes/enviar_mensagem.php', {
        method: 'POST',
        body: formData
    })
    .then(() => {
        form.reset(); 
        atualizarChat(); 
    });
}
</script>

<!-- EVENTOS -->
<script>
function atualizarEventos() {
    fetch('../acoes/buscar_eventos.php?id_grupo=<?php echo $id_grupo; ?>')
    .then(response => response.text())
    .then(data => {
        document.getElementById("eventos").innerHTML = data;

        for (let id in abasAbertas) {
            if (abasAbertas[id]) {
                let box = document.getElementById("participantes-" + id);
                if (box) {
                    box.style.display = "block";
                }
            }
        }
    });
}

atualizarEventos();
setInterval(atualizarEventos, 3000);
</script>

<script>
function enviarStatus(form, status) {
    const formData = new FormData(form);
    formData.set("status", status);

    fetch('../acoes/responder_evento.php', {
        method: 'POST',
        body: formData
    }).then(() => {
        atualizarEventos();
    });
}
</script>

<script>
function toggleParticipantes() {
    var box = document.getElementById("participantes-box");

    if (box.style.display === "none") {
        box.style.display = "block";
    } else {
        box.style.display = "none";
    }
}
</script>

<script>
function toggleParticipantesEvento(id) {
    let box = document.getElementById("participantes-" + id);

    if (box.style.display === "none") {
        box.style.display = "block";
        abasAbertas[id] = true;
    } else {
        box.style.display = "none";
        abasAbertas[id] = false;
    }
}
</script>

<script>
function toggleMenu() {
    var menu = document.getElementById("menu-box");

    if(menu.style.display === "block"){
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

// fecha ao clicar fora
document.addEventListener("click", function(e){
    var menu = document.getElementById("menu-box");
    var botao = document.querySelector(".btn-menu");

    if(menu && !menu.contains(e.target) && !botao.contains(e.target)){
        menu.style.display = "none";
    }
});
</script>

<script>
function confirmarExclusao(id_grupo){
    if(confirm("Tem certeza que deseja excluir este grupo?")){
        window.location.href = "../acoes/excluir_grupo.php?id=" + id_grupo;
    }
}
</script>

<script>
function confirmarExcluirEvento(id_evento, id_grupo){
    if(confirm("Tem certeza que deseja excluir este evento?")){
        window.location.href = "../acoes/excluir_evento.php?id=" + id_evento + "&id_grupo=" + id_grupo;
    }
}
</script>

<script>
function confirmarSaida(id_grupo){
    if(confirm("Tem certeza que deseja sair deste grupo?")){
        window.location.href = "../acoes/sair_grupo.php?id=" + id_grupo;
    }
}
</script>

<script>
function toggleMenuEvento(id) {
    let menu = document.getElementById("menu-evento-" + id);

    if(menu.style.display === "block"){
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

// fechar ao clicar fora
document.addEventListener("click", function(e){
    document.querySelectorAll(".menu-box").forEach(menu => {
        if(!menu.contains(e.target) && !e.target.classList.contains("btn-menu")){
            menu.style.display = "none";
        }
    });
});
</script>

</body>
</html>