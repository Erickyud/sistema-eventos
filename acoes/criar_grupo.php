<?php
include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

$codigo = substr(md5(time()), 0, 6);
$sql = "INSERT INTO grupo_eventos (nome,descricao,codigo)
VALUES ('$nome','$descricao','$codigo')";

if(mysqli_query($conexao,$sql)){
    header("Location: ../telas/tela_principal.php");
}

else{
    echo "Erro ao criar grupo.";
}
?>