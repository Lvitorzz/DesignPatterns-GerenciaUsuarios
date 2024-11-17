<?php
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/BuyerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/SellerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/AbstractDeleteAccount.php';
    class SellerDeleteAccount extends AbstractDeleteAccount {
        protected function verificarPendencias() {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM vendas WHERE id_user = ? AND concluida = 0");
            $query->execute([$this->user['id_user']]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'] == 0;
        }
    
        protected function mensagemPendencias() {
            return "Não é possível excluir a conta. Existem vendas pendentes associadas.";
        }
    }
?>
