<?php
session_start();
include("../config/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";

$resultado = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0){
    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    header("Location: ../telas/tela_principal.php");
    exit;
}

else{
    echo "Email ou senha incorretos.";
}
?>