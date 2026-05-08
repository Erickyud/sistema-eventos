<?php
session_start();
include("../config/conexao.php");

$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
$data_evento = $_POST['data_evento'];
$hora_evento = $_POST['hora_evento'];

$rua = mysqli_real_escape_string($conexao, trim($_POST['rua'] ?? ''));
$numero = mysqli_real_escape_string($conexao, trim($_POST['numero'] ?? ''));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro'] ?? ''));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade'] ?? ''));

$local = "";
if(!empty($rua)){
    $local = $rua;
    if(!empty($numero)) $local .= ", " . $numero;
    if(!empty($bairro)) $local .= " - " . $bairro;
    if(!empty($cidade)) $local .= ", " . $cidade;
}
$latitude = isset($_POST['latitude']) && $_POST['latitude'] !== '' ? "'" . mysqli_real_escape_string($conexao, $_POST['latitude']) . "'" : "NULL";
$longitude = isset($_POST['longitude']) && $_POST['longitude'] !== '' ? "'" . mysqli_real_escape_string($conexao, $_POST['longitude']) . "'" : "NULL";
$grupo_id = (int)$_POST['grupo_id'];
$usuario_id = $_SESSION['usuario_id'];

// Verificar se o usuário é o criador do grupo ou admin
$sql_check = "
    SELECT ge.criador_id, gu.is_admin 
    FROM grupo_eventos ge
    JOIN grupo_usuarios gu ON gu.id_grupo = ge.id
    WHERE ge.id = $grupo_id AND gu.id_usuario = $usuario_id
";
$result_check = mysqli_query($conexao, $sql_check);
$grupo = mysqli_fetch_assoc($result_check);

if (!$grupo || ($grupo['criador_id'] != $usuario_id && $grupo['is_admin'] == 0)) {
    die("Acesso negado.");
}

$sql = "INSERT INTO eventos 
(nome, descricao, data_evento, hora_evento, local, latitude, longitude, grupo_id)
VALUES 
('$nome', '$descricao', '$data_evento', '$hora_evento', '$local', $latitude, $longitude, $grupo_id)";

if(mysqli_query($conexao, $sql)){
    
    header("Location: ../telas/grupo.php?id_grupo=" . $grupo_id);
    exit;

}else{
    echo "Erro ao criar evento: " . mysqli_error($conexao);
}
?>