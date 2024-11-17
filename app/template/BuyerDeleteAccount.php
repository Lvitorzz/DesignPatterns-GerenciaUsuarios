<?php
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/BuyerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/SellerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/AbstractDeleteAccount.php';
    class BuyerDeleteAccount extends AbstractDeleteAccount {
        protected function verificarPendencias() {
            $query = $this->db->prepare("SELECT COUNT(*) as total FROM compras WHERE id_user = ? AND concluida = 0");
            $query->execute([$this->user['id_user']]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'] == 0;
        }
    
        protected function mensagemPendencias() {
            return "Não é possível excluir a conta. Existem compras pendentes associadas.";
        }
    }
?>
