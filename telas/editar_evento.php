<?php
include("../config/conexao.php");

$id = $_GET['id'];

$evento = mysqli_fetch_assoc(mysqli_query($conexao, "
    SELECT * FROM eventos WHERE id = $id
"));
?>

<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        
        <h1 class="page-title">Editar Evento</h1>

        <form action="../acoes/atualizar_evento.php" method="POST" class="glass-form">

            <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
            <input type="hidden" name="grupo_id" value="<?php echo $evento['grupo_id']; ?>">

            <!-- NOME -->
            <label class="form-label">Nome do Evento:</label>
            <input type="text" name="nome" class="form-input"
                   value="<?php echo $evento['nome']; ?>" required>

            <!-- DESCRIÇÃO -->
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-input" rows="4"
                      placeholder="Detalhes do evento..."><?php echo $evento['descricao']; ?></textarea>

            <!-- DATA + HORA -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 10px;">
                
                <div>
                    <label class="form-label">Data:</label>
                    <input type="date" name="data_evento" class="form-input"
                           value="<?php echo $evento['data_evento']; ?>">
                </div>

                <div>
                    <label class="form-label">Hora:</label>
                    <input type="time" name="hora_evento" class="form-input"
                           value="<?php echo $evento['hora_evento']; ?>">
                </div>

            </div>

            <!-- LOCAL -->
            <label class="form-label">Local:</label>
            <input type="text" name="local" class="form-input"
                   value="<?php echo $evento['local']; ?>">

            <!-- BOTÕES -->
            <div style="display: flex; justify-content: space-between; margin-top: 25px;">
                
                <a href="grupo.php?id_grupo=<?php echo $evento['grupo_id']; ?>" 
                   class="btn" style="background: #6b7280;">
                    Cancelar
                </a>

                <button type="submit" class="btn">
                    Salvar Alterações
                </button>

            </div>

        </form>
    </div>
</main>

<?php include 'footer.php'; ?>