<?php
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/strategy/UserStrategy.php';
class SellerStrategy implements UserStrategy {
    public function listarUsuarios($db) {
        $query = "SELECT * FROM users WHERE userType = 'comprador'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>