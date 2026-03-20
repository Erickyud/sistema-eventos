<?php

include("../config/conexao.php");

$codigo = $_POST['codigo'];

$sql = "SELECT * FROM grupo_eventos WHERE codigo='$codigo'";
$resultado = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0){

    $grupo = mysqli_fetch_assoc($resultado);

    header("Location: ../telas/grupo.php?id=" . $grupo['id']);
    exit;

}else{

    echo "Código inválido.";

}

?>