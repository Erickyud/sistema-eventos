<?php
session_start();
include("../config/conexao.php");
include("header.php");

$usuario_id = $_SESSION['usuario_id'] ?? 0;

$grupos = mysqli_query($conexao, "
    SELECT g.* FROM grupo_eventos g
    JOIN grupo_usuarios gu ON gu.id_grupo = g.id
    WHERE gu.id_usuario = $usuario_id
");
?>

<div class="dashboard-container">

    <h1 class="page-title">Meus Grupos</h1>

    <div class="acoes-grupo">
        <a href="criar_grupo.php" class="btn">+ Criar Grupo</a>
        <a href="entrar_grupo.php" class="btn">Entrar com código</a>
    </div>

    <div class="grupos-container">

        <?php while($grupo = mysqli_fetch_assoc($grupos)){ ?>

            <a href="grupo.php?id_grupo=<?php echo $grupo['id']; ?>" class="card-grupo">
                <h3><?php echo $grupo['nome']; ?></h3>
                <p><?php echo $grupo['descricao']; ?></p>
            </a>

        <?php } ?>

    </div>

</div>