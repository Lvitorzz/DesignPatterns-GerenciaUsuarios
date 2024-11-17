<?php 
class SellerPainel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function show() {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM vendas WHERE id_user = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        echo "<button><a href='/GerenciaUsuario/public/home'>Voltar</a></button>";
        echo "<h2>Suas Vendas</h2>";
        echo "<table border='1'><tr><th>ID Venda</th><th>Produto Vendido</th><th>Pendente</th><th>Ação</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nomeProduto']}</td>
                    <td>" . ($row['concluida'] ? 'Não' : 'Sim') . "</td>
                    <td>";
            
            if (!$row['concluida']) {
                echo "<form method='POST' action=''>
                        <input type='hidden' name='venda_id' value='{$row['id']}'>
                        <button type='submit' name='concluir_venda'>Concluir</button>
                      </form>";
            }
            echo "</td></tr>";
        }
        echo "</table>";

        if (isset($_POST['concluir_venda'])) {
            $this->concluirVenda($_POST['venda_id']);
        }
    }

    public function concluirVenda($venda_id) {
        $query = "UPDATE vendas SET concluida = true WHERE id = :venda_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':venda_id', $venda_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Venda concluída com sucesso!'); window.location.href = '/GerenciaUsuario/public/painel';</script>";
        } else {
            echo "<script>alert('Erro ao concluir a venda.');</script>";
        }
    }
}
?>
