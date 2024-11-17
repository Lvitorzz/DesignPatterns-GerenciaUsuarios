<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Faça seu cadastro</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <script>
        function updateField() {
            var userType = document.getElementById("userType").value;
            var label = document.getElementById("labelDocumento");
            var input = document.getElementById("document");

            if (userType === "vendedor") {
                label.innerText = "CNPJ:";
            } else {
                label.innerText = "CPF:";
            }
        }

        window.onload = function() {
            updateField();
        };
    </script>
</head>
<body>
    <div class="container-register">
        <h1>Faça seu cadastro</h1>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="name">Nome:</label>
            <input type="text" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="password">Senha:</label>
            <input type="password" name="password" required>
            <br>
            <label for="userType">Tipo de Usuário:</label>
            <select name="userType" id="userType" onchange="updateField()">
                <option value="comprador">Comprador</option>
                <option value="vendedor">Vendedor</option>
            </select>
            <br>
            <label id="labelDocumento" for="document">CPF:</label>
            <input type="text" id="document" name="document" required>
            <br>
            <button type="submit">Registrar</button>
            <p>Já tem uma conta? <a href="/GerenciaUsuario/public/login">Faça login aqui</a></p>
        </form>
    </div>
</body>
</html>
