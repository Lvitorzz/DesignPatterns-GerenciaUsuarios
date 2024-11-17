<?php
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/BuyerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/SellerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/AbstractDeleteAccount.php';
abstract class AbstractDeleteAccount {
    protected $db;
    protected $user;

    public function __construct($db, $user) {
        $this->db = $db;
        $this->user = $user;
    }

    public function excluirConta() {
        if (!$this->validarSenha()) {
            return "Senha inválida!";
        }

        if (!$this->verificarPendencias()) {
            return $this->mensagemPendencias();
        }

        return $this->deletarUsuario();
    }

    protected function validarSenha() {
        return password_verify($_POST['password'], $this->user['password']);
    }

    protected abstract function verificarPendencias();
    protected abstract function mensagemPendencias();

    private function deletarUsuario() {
        $query = $this->db->prepare("DELETE FROM users WHERE id_user = ?");
        if ($query->execute([$this->user['id_user']])) {
            return "Conta excluída com sucesso!";
        }
        return "Erro ao excluir a conta!";
    }
}
?>