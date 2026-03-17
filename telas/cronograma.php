<?php
include("../config/conexao.php");

$sql = "SELECT eventos.*, grupo_eventos.nome AS grupo_nome
FROM eventos
LEFT JOIN grupo_eventos
ON eventos.grupo_id = grupo_eventos.id
ORDER BY data_evento, hora_evento";

$resultado = mysqli_query($conexao,$sql);
?>

<?php include 'header.php'; ?>

<main class="dashboard-container">
    <div class="glass-card" style="max-width: 100%; overflow: visible;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
            <h1 class="page-title">Cronograma de Eventos</h1>
            <a href="tela_principal.php" class="btn">Voltar ao Dashboard</a>
        </div>
        
        <div class="table-container">
            <table class="event-table">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Grupo</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Local</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($evento = mysqli_fetch_assoc($resultado)){ ?>
                    <tr>
                        <td><?php echo $evento['nome']; ?></td>
                        <td><?php echo $evento['grupo_nome'] ?? 'Sem grupo'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($evento['data_evento'])); ?></td>
                        <td><?php echo date('H:i', strtotime($evento['hora_evento'])); ?></td>
                        <td><?php echo $evento['local']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <?php if(mysqli_num_rows($resultado) == 0): ?>
        <div style="text-align: center; padding: 4rem 2rem; color: #6b7280;">
            <h3>Nenhum evento encontrado</h3>
            <p>Crie seu primeiro grupo e evento no dashboard.</p>
            <a href="tela_principal.php" class="btn" style="background: #3b82f6; margin-top: 1rem; display: inline-block;">Começar</a>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
