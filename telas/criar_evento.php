<?php
include("../config/conexao.php");

$id = $_GET['id'];
?>

<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        <h1 class="page-title">Criar Evento</h1>
        
        <form action="../acoes/criar_evento.php" method="POST" class="glass-form">

            <input type="hidden" name="grupo_id" value="<?php echo $id; ?>">

            <label class="form-label" for="nome_evento">Nome do Evento:</label>
            <input type="text" id="nome_evento" name="nome" class="form-input" required>
            
            <label class="form-label" for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-input" rows="5" placeholder="Detalhes do evento..."></textarea>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="data_evento">Data:</label>
                    <input type="date" id="data_evento" name="data_evento" class="form-input">
                </div>
                <div>  
                    <label class="form-label" for="hora_evento">Hora:</label>
                    <input type="time" id="hora_evento" name="hora_evento" class="form-input">
                </div>
            </div>
            
            <label class="form-label" for="local">Local:</label>
            <input type="text" id="local" name="local" class="form-input" placeholder="Endereço do evento">
            
            <div style="display: flex; gap: 1rem; justify-content: space-between; align-items: center; margin-top: 2rem;">
                <a href="tela_principal.php" class="btn" style="background: #6b7280;">Cancelar</a>
                <button type="submit" class="btn">Criar Evento</button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
