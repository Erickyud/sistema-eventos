<?php
session_start();
include("../config/conexao.php");

$codigo = $_POST['codigo'];
$id_usuario = $_SESSION['usuario_id'];

$sql = "SELECT * FROM grupo_eventos WHERE codigo = '$codigo'";
$res = mysqli_query($conexao, $sql);

if(mysqli_num_rows($res) > 0){

    $grupo = mysqli_fetch_assoc($res);
    $id_grupo = $grupo['id'];

    mysqli_query($conexao, "
        INSERT INTO grupo_usuarios (id_grupo, id_usuario)
        VALUES ($id_grupo, $id_usuario)
    ");

    header("Location: ../telas/tela_principal.php");
} else {
    echo "Código inválido";
}
?>