<?php
session_start();
include("../config/conexao.php");
include("header.php");

$id = $_GET['id'];

$grupo = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM grupo_eventos WHERE id=$id"));
?>

<div class="voltar-container">
    <a href="tela_principal.php" class="btn-voltar">← Voltar</a>
</div>

<div class="grupo-container">

    <!-- CHAT -->
    <div class="chat-box">
        <h2><?php echo $grupo['nome']; ?></h2>

        <div class="chat-mensagens" id="chat"></div>

        <form class="chat-form" onsubmit="enviarMensagem(event)">
            <input type="hidden" name="id_grupo" value="<?php echo $id; ?>">
            <input type="text" name="mensagem" placeholder="Digite uma mensagem..." required>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <div class="eventos-box">
        <h3>Eventos</h3>

        <div id="eventos"></div>

        <a href="criar_evento.php?id=<?php echo $id; ?>" class="btn">+ Criar Evento</a>
    </div>

</div>

</main>

<script>
let ultimoTamanho = 0;

function atualizarChat() {
    fetch('../acoes/buscar_mensagens.php?id_grupo=<?php echo $id; ?>')
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

<script>
function atualizarEventos() {
    fetch('../acoes/buscar_eventos.php?id_grupo=<?php echo $id; ?>')
    .then(response => response.text())
    .then(data => {
        document.getElementById("eventos").innerHTML = data;
    });
}

atualizarEventos();
setInterval(atualizarEventos, 3000);
</script>


</body>
</html>