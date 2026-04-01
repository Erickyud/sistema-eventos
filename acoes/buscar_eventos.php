<?php
session_start();
include("../config/conexao.php");

$id_usuario = $_SESSION['usuario_id'] ?? 0;
$id_grupo = $_GET['id_grupo'];

$grupo = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT * FROM grupo_eventos WHERE id = $id_grupo
"));

$sql = "SELECT * FROM eventos WHERE grupo_id = $id_grupo ORDER BY data_evento ASC";
$resultado = mysqli_query($conexao, $sql);

while($e = mysqli_fetch_assoc($resultado)){

    $id_evento = $e['id'];

    // contar quem vai
    $qtd_vou = mysqli_fetch_assoc(mysqli_query($conexao, "
        SELECT COUNT(*) as total FROM presencas 
        WHERE id_evento = $id_evento AND status = 'vou'
    "))['total'];

// contar quem não vai
    $qtd_nao = mysqli_fetch_assoc(mysqli_query($conexao, "
        SELECT COUNT(*) as total FROM presencas 
        WHERE id_evento = $id_evento AND status = 'nao_vou'
    "))['total'];

    $total_usuarios = mysqli_num_rows(mysqli_query($conexao, "
        SELECT * FROM grupo_usuarios WHERE id_grupo = $id_grupo
    "));

    $qtd_nao_respondeu = $total_usuarios - ($qtd_vou + $qtd_nao);

    $sql_status = "SELECT status FROM presencas 
                   WHERE id_evento = {$e['id']} AND id_usuario = $id_usuario";

    $res_status = mysqli_query($conexao, $sql_status);
    $row = mysqli_fetch_assoc($res_status);

    if($row){
        $status = $row['status'];
    }else{
        $status = '';
    }
?>

    
    <div class="evento-item">

        <div class="topo-evento">
            <strong class="titulo-evento"><?php echo $e['nome']; ?></strong>

        <?php if($grupo['criador_id'] == $id_usuario){ ?>
            <div class="menu-opcoes">
                <button onclick="toggleMenuEvento(<?php echo $e['id']; ?>)" class="btn-menu">⋮</button>

            <div id="menu-evento-<?php echo $e['id']; ?>" class="menu-box">
                <a href="javascript:void(0)" onclick="confirmarExcluirEvento(<?php echo $e['id']; ?>, <?php echo $id_grupo; ?>)">
                    🗑 Excluir
                </a>
                <a href="../telas/editar_evento.php?id=<?php echo $e['id']; ?>">✏️ Editar</a>
            </div>
            </div>
        <?php } ?>
    </div>

        <p><?php echo $e['descricao']; ?></p>
        <p>📍 <?php echo $e['local']; ?></p>
        <p>📅 <?php echo $e['data_evento']; ?> às <?php echo $e['hora_evento']; ?></p>

        <p>
            <?php 
            if($status == 'vou') echo '✔ Você vai';
            elseif($status == 'nao_vou') echo '❌ Você não vai';
            else echo 'Sem resposta';
            ?>
        </p>

        <form class="form-presenca" onsubmit="responderEvento(event, this)">
            <input type="hidden" name="id_evento" value="<?php echo $e['id']; ?>">

            <button type="button" onclick="enviarStatus(this.form, 'vou')">✔ Vou</button>
            <button type="button" onclick="enviarStatus(this.form, 'nao_vou')">❌ Não vou</button>
        </form>

        <button onclick="toggleParticipantesEvento(<?php echo $e['id']; ?>)">
            👥 Ver participantes
        </button>

        <div id="participantes-<?php echo $e['id']; ?>" class="participantes-box" style="display:none;">

        <?php
        $id_evento = $e['id'];

    $usuarios = mysqli_query($conexao, "
        SELECT u.* FROM usuarios u
        JOIN grupo_usuarios gu ON gu.id_usuario = u.id
        WHERE gu.id_grupo = $id_grupo
    ");

    $presencas = mysqli_query($conexao, "
        SELECT * FROM presencas WHERE id_evento = $id_evento
    ");

    $respostas = [];

    while($p = mysqli_fetch_assoc($presencas)){
        $respostas[$p['id_usuario']] = $p['status'];
    }
    ?>

    <h4>✔ Vão (<?php echo $qtd_vou; ?>)</h4>
    <?php
    $vou = mysqli_query($conexao, "
        SELECT u.nome FROM presencas p
        JOIN usuarios u ON u.id = p.id_usuario
        WHERE p.id_evento = $id_evento AND p.status = 'vou'
    ");

    while($v = mysqli_fetch_assoc($vou)){
        echo "<p>👤 " . $v['nome'] . "</p>";
    }
    ?>

    <h4>❌ Não vão (<?php echo $qtd_nao; ?>)</h4>
    <?php
    $nao = mysqli_query($conexao, "
        SELECT u.nome FROM presencas p
        JOIN usuarios u ON u.id = p.id_usuario
        WHERE p.id_evento = $id_evento AND p.status = 'nao_vou'
    ");

    while($n = mysqli_fetch_assoc($nao)){
        echo "<p>👤 " . $n['nome'] . "</p>";
    }
?>

    <h4>⏳ Não responderam (<?php echo $qtd_nao_respondeu; ?>)</h4>
    <?php
    mysqli_data_seek($usuarios, 0);
    while($u = mysqli_fetch_assoc($usuarios)){
        if(!isset($respostas[$u['id']])){
            echo "<p>👤 " . $u['nome'] . "</p>";
        }
    }
    ?>

</div>

    </div>

<?php } ?>