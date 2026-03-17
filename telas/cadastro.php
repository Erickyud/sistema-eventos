<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Usuário</title>
</head>
<body>

<h2>Criar Conta</h2>

<form action="../acoes/cadastrar_usuario.php" method="POST">

<label>Nome:</label>
<input type="text" name="nome" required>
<br><br>
<label>Email:</label>
<input type="email" name="email" required>
<br><br>
<label>Senha:</label>
<input type="password" name="senha" required>
<br><br>
<button type="submit">Cadastrar</button>

</form>

</body>
</html>