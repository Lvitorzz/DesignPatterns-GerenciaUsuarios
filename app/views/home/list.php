<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
    <h1>
    <?php
    if (isset($_SESSION['userType'])) {
        echo ($_SESSION['userType'] === 'vendedor') ? 'Vendedores Cadastrados' : 'Compradores Cadastrados';
    } else {
        echo 'Tipo de usuário não definido.';
    }
    ?>
</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id_user']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['userType']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">Nenhum usuário encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p><a href="/GerenciaUsuario/public/home">Voltar</a></p>
    </div>
</body>
</html>