<?php
include("../config/conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios (nome,email,senha)
VALUES ('$nome','$email','$senha')";

if(mysqli_query($conexao,$sql)){
    header("Location: ../telas/login.php");
}

else{
    echo "Erro ao cadastrar.";
}
?>