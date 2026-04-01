<?php
session_start();
include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$criador_id = $_SESSION['usuario_id'];

$codigo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

$sql = "INSERT INTO grupo_eventos (nome, descricao, codigo, criador_id)
        VALUES ('$nome', '$descricao', '$codigo', $criador_id)";

if(mysqli_query($conexao, $sql)){

    $id_grupo = mysqli_insert_id($conexao);

    $id_usuario = $_SESSION['usuario_id'];

    mysqli_query($conexao, "
        INSERT INTO grupo_usuarios (id_grupo, id_usuario)
        VALUES ($id_grupo, $id_usuario)
    ");

    header("Location: ../telas/tela_principal.php");
    exit;

}else{
    echo "Erro ao criar grupo.";
}
?>