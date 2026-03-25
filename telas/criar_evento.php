<?php
session_start();
include("../config/conexao.php");

$id_grupo = $_GET['id_grupo'] ?? 0;

if($id_grupo == 0){
    echo "Erro: grupo não informado.";
    exit;
}
?>

<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 600px; margin: 0 auto;">
        <h1 class="page-title">Criar Evento</h1>
        
        <form action="../acoes/criar_evento.php" method="POST" class="glass-form">

            <input type="hidden" name="grupo_id" value="<?php echo $id_grupo; ?>">

            <label class="form-label">Nome do Evento:</label>
            <input type="text" name="nome" class="form-input" required>
            
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-input" rows="5" placeholder="Detalhes do evento..."></textarea>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label">Data:</label>
                    <input type="date" name="data_evento" class="form-input">
                </div>
                <div>  
                    <label class="form-label">Hora:</label>
                    <input type="time" name="hora_evento" class="form-input">
                </div>
            </div>
            
            <label class="form-label">Local:</label>
            <input type="text" name="local" class="form-input" placeholder="Endereço do evento">
            
            <div style="display: flex; gap: 1rem; justify-content: space-between; align-items: center; margin-top: 2rem;">
                
                <a href="grupo.php?id_grupo=<?php echo $id_grupo; ?>" class="btn" style="background: #6b7280;">
                    Cancelar
                </a>

                <button type="submit" class="btn">Criar Evento</button>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
