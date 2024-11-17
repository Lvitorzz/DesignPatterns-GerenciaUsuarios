<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Conta</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container-excluir">
        <h1>Excluir Conta</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="password">Senha:</label>
            <input type="password" name="password" required>
            <button type="submit">Excluir Conta</button>
            
        </form>
        <a href="/GerenciaUsuario/public/home">voltar</a>
    </div>
</body>
</html>