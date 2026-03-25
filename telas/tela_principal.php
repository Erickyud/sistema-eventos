<?php
include("../config/conexao.php");
include("header.php");

$grupos = mysqli_query($conexao, "SELECT * FROM grupo_eventos");
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