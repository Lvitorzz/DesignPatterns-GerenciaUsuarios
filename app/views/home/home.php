<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container-home">
        <h1>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</h1>
        <p><a href="/GerenciaUsuario/public/list">Visualizar outros usuários</a></p>
        <p><a href="/GerenciaUsuario/public/edit">Editar meu Perfil</a></p>
        <p><a href="/GerenciaUsuario/public/delete">Excluir minha Conta</a></p>
        <p><a href="/GerenciaUsuario/public/logout">Logout</a></p>
    </div>
    
</body>
</html>