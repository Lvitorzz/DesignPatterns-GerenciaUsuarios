<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Acesse sua conta</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
    <h1>Acesse sua conta</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="password">Senha:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <p>Não tem uma conta? <a href="/GerenciaUsuario/public/register">Registre-se aqui</a></p>
    </div>    
</body>
</html>