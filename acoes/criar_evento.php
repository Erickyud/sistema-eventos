<?php
session_start();
include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data_evento = $_POST['data_evento'];
$hora_evento = $_POST['hora_evento'];
$local = $_POST['local'];
$grupo_id = $_POST['grupo_id'];

$sql = "INSERT INTO eventos 
(nome, descricao, data_evento, hora_evento, local, grupo_id)
VALUES 
('$nome', '$descricao', '$data_evento', '$hora_evento', '$local', $grupo_id)";

if(mysqli_query($conexao, $sql)){
    
    header("Location: ../telas/grupo.php?id_grupo=" . $grupo_id);
    exit;

}else{
    echo "Erro ao criar evento: " . mysqli_error($conexao);
}
?>