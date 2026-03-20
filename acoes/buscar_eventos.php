<?php
include("../config/conexao.php");

$id_grupo = $_GET['id_grupo'];

$sql = "SELECT * FROM eventos WHERE grupo_id = $id_grupo ORDER BY data_evento ASC";

$resultado = mysqli_query($conexao, $sql);

while($e = mysqli_fetch_assoc($resultado)){
?>
    <div class="evento-item">
        <strong><?php echo $e['nome']; ?></strong>
        <p><?php echo $e['descricao']; ?></p>
        <p>📍 <?php echo $e['local']; ?></p>
        <p>📅 <?php echo $e['data_evento']; ?> às <?php echo $e['hora_evento']; ?></p>
    </div>
<?php } ?>