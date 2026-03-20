<?php
session_start();
include("../config/conexao.php");

$id_usuario = $_SESSION['usuario_id'];

$id_grupo = $_GET['id_grupo'];

$sql = "
SELECT m.*, u.nome 
FROM mensagens m
JOIN usuarios u ON m.id_usuario = u.id
WHERE m.id_grupo = $id_grupo
ORDER BY m.data_envio ASC
";

$resultado = mysqli_query($conexao, $sql);

while($msg = mysqli_fetch_assoc($resultado)){
?>
    <div class="mensagem <?php echo ($msg['id_usuario'] == $id_usuario) ? 'minha' : ''; ?>">
    <div class="mensagem-topo">
        <img src="../img/avatar.png" class="avatar">
        <span class="nome"><?php echo $msg['nome']; ?></span>

        <span class="hora">
            <?php echo date('H:i', strtotime($msg['data_envio'])); ?>
        </span>
    </div>
    <p><?php echo $msg['mensagem']; ?></p>
</div>
<?php } ?>