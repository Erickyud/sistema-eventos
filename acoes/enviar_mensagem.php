<?php
session_start();
include("../config/conexao.php");

$id_grupo = $_POST['id_grupo'];
$mensagem = $_POST['mensagem'];

$id_usuario = $_SESSION['usuario_id'];

$sql = "INSERT INTO mensagens (id_grupo, id_usuario, mensagem)
        VALUES ($id_grupo, $id_usuario, '$mensagem')";

mysqli_query($conexao, $sql);

header("Location: ../telas/grupo.php?id=$id_grupo");
exit;