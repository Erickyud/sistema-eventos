<?php
include("../config/conexao.php");

$grupos = mysqli_query($conexao,"SELECT * FROM grupo_eventos");
?>

<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        <h1 class="page-title">Criar Evento</h1>
        
        <form action="../acoes/criar_evento.php" method="POST" class="glass-form">
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
            
            <label class="form-label" for="grupo_id">Grupo:</label>
            <select id="grupo_id" name="grupo_id" class="form-input">
                <option value="">Selecione um grupo</option>
                <?php
                while($grupo = mysqli_fetch_assoc($grupos)){
                ?>
                <option value="<?php echo $grupo['id']; ?>">
                    <?php echo $grupo['nome']; ?>
                </option>
                <?php
                }
                ?>
            </select>
            
            <div style="display: flex; gap: 1rem; justify-content: space-between; align-items: center; margin-top: 2rem;">
                <a href="tela_principal.php" class="btn" style="background: #6b7280;">Cancelar</a>
                <button type="submit" class="btn">Criar Evento</button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
