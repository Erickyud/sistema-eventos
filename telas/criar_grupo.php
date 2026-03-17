<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        <h1 class="page-title">Criar Grupo de Eventos</h1>
        
        <form action="../acoes/criar_grupo.php" method="POST" class="glass-form">
            <label class="form-label" for="nome">Nome do grupo:</label>
            <input type="text" id="nome" name="nome" class="form-input" required>
            
            <label class="form-label" for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-input" rows="6" placeholder="Descreva o grupo..."></textarea>
            
            <div style="display: flex; gap: 1rem; justify-content: space-between; align-items: center;">
                <a href="tela_principal.php" class="btn" style="background: #6b7280;">Cancelar</a>
                <button type="submit" class="btn">Criar Grupo</button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
