<?php
include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO grupo_eventos (nome,descricao)
VALUES ('$nome','$descricao')";

if(mysqli_query($conexao,$sql)){
    header("Location: ../telas/tela_principal.php");
}

else{
    echo "Erro ao criar grupo.";
}
?>