<?php
include("../config/conexao.php");

$id = $_POST['id'];
$grupo_id = $_POST['grupo_id'];

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$data = $_POST['data_evento'];
$hora = $_POST['hora_evento'];
$local = $_POST['local'];

mysqli_query($conexao, "
    UPDATE eventos SET 
        nome = '$nome',
        descricao = '$descricao',
        data_evento = '$data',
        hora_evento = '$hora',
        local = '$local'
    WHERE id = $id
");

header("Location: ../telas/grupo.php?id_grupo=" . $grupo_id);
exit;