<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1>Editar Perfil</h1>
    <form method="post">
        <label for="name">Nome:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <br>
        <label for="password">Nova Senha:</label>
        <input type="password" name="password">
        <br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>