<?php
include("../config/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";

$resultado = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0){
    header("Location: ../telas/tela_principal.php");
    exit;
}

else{
    echo "Email ou senha incorretos.";
}
?>