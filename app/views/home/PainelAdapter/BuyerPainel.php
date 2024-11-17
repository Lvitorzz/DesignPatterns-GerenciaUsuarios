<?php 
class BuyerPainel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function show() {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM compras WHERE id_user = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        echo "<button><a href='/GerenciaUsuario/public/home'>Voltar</a></button>";
        echo "<h2>Suas Compras</h2>";
        echo "<table border='1'><tr><th>ID Compra</th><th>Produto Comprado</th><th>Pendente</th><th>Ação</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nomeProduto']}</td>
                    <td>" . ($row['concluida'] ? 'Não' : 'Sim') . "</td>
                    <td>";
            
            if (!$row['concluida']) {
                echo "<form method='POST' action=''>
                        <input type='hidden' name='compra_id' value='{$row['id']}'>
                        <button type='submit' name='concluir_compra'>Concluir</button>
                      </form>";
            }
            echo "</td></tr>";
        }
        echo "</table>";

        if (isset($_POST['concluir_compra'])) {
            $this->concluirCompra($_POST['compra_id']);
        }
    }

    public function concluirCompra($compra_id) {
        $query = "UPDATE compras SET concluida = true WHERE id = :compra_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':compra_id', $compra_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Compra concluída com sucesso!'); window.location.href = '/GerenciaUsuario/public/painel';</script>";
        } else {
            echo "<script>alert('Erro ao concluir a compra.');</script>";
        }
    }
}
?>
