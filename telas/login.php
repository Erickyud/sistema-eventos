<?php include 'header.php'; ?>

<main class="login-container">
    <section class="glass-card">
        <h2 class="neon-title">Login</h2>

        <form action="../acoes/login.php" method="POST" class="glass-form">
            <label class="form-label" for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-input" required>

            <label class="form-label" for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-input" required>

            <button type="submit" class="btn">Entrar</button>
        </form>

        <a href="cadastro.php" class="link-neon">Criar conta</a>
    </section>
</main>

</body>

</html>