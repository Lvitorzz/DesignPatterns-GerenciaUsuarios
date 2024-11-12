<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <script>
        function updateField() {
            var userType = document.getElementById("userType").value;
            var label = document.getElementById("labelDocumento");
            var input = document.getElementById("documento");

            if (userType === "vendedor") {
                label.innerText = "CNPJ:";
                input.setAttribute("name", "cnpj");
            } else {
                label.innerText = "CPF:";
                input.setAttribute("name", "cpf");
            }
        }

        window.onload = function() {
            updateField();
        };
    </script>
</head>
<body>
    <div class="container">
        <h1>Registrar</h1>
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
            <label id="labelDocumento" for="documento">CPF:</label>
            <input type="text" id="documento" required>
            <br>
            <button type="submit">Registrar</button>
            <p>Já tem uma conta? <a href="/GerenciaUsuario/public/login">Faça login aqui</a></p>
        </form>
    </div>
</body>
</html>
