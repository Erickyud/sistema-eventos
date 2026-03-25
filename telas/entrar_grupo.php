<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 400px; margin: auto;">
        <h2 class="page-title">Entrar no Grupo</h2>

        <form action="../acoes/entrar_grupo.php" method="POST" class="glass-form">
            <input type="text" name="codigo" placeholder="Digite o código do grupo" class="form-input" required>

            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>