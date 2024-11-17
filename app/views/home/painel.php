<?php
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/PainelAdapter/PainelAdapter.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/PainelAdapter/BuyerPainel.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/PainelAdapter/SellerPainel.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/PainelAdapter/BuyerPainelAdapter.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/PainelAdapter/SellerPainelAdapter.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/config/database.php';

function adicionar($db) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto'])) {
        $produto = $_POST['produto'];
        $id_user = $_SESSION['user_id'];
        $userType = $_SESSION['userType'];
        $pendente = false;

        $tabela = $userType === 'vendedor' ? 'vendas' : 'compras';

        try {
            $query = "INSERT INTO $tabela (id_user, nomeProduto, concluida) VALUES (:id_user, :produto, :pendente)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':produto', $produto);
            $stmt->bindParam(':pendente', $pendente, PDO::PARAM_BOOL);

            if ($stmt->execute()) {
                echo "<script>alert('" . ucfirst($userType) . " adicionada com sucesso!'); window.location.href='/GerenciaUsuario/public/painel';</script>";
            } else {
                echo "<script>alert('Erro ao adicionar " . $userType . ".'); window.history.back();</script>";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    adicionar($db);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        /* Estilo para o modal */
        #addCompraModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #modalOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <div id="modalOverlay" onclick="hideModal()"></div>
    <div class="container-painel">
        <?php
        $userType = $_SESSION['userType'];
        $menu = null;

        if ($userType === 'vendedor') {
            $sellerPainel = new SellerPainel($db); 
            $menu = new SellerPainelAdapter($sellerPainel);
        } elseif ($userType === 'comprador') {
            $buyerPainel = new BuyerPainel($db);
            $menu = new BuyerPainelAdapter($buyerPainel);
        }

        $menu->showPainel();
        ?>

        <?php if ($userType === 'comprador'): ?>
            <button onclick="showModal('compra')">Adicionar Compra</button>
        <?php elseif ($userType === 'vendedor'): ?>
            <button onclick="showModal('venda')">Adicionar Venda</button>
        <?php endif; ?>

        <!-- Modal para adicionar compra -->
        <div id="addCompraModal">
            <h3>Adicionar</h3>
            <form method="POST">
                <label for="produto">Nome do Produto:</label>
                <input type="text" name="produto" id="produto" required>
                <button type="submit">Salvar</button>
                <button type="button" onclick="hideModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        function showModal() {
            document.getElementById('addCompraModal').style.display = 'block';
            document.getElementById('modalOverlay').style.display = 'block';
        }

        function hideModal() {
            document.getElementById('addCompraModal').style.display = 'none';
            document.getElementById('modalOverlay').style.display = 'none';
        }
    </script>
</body>
</html>
