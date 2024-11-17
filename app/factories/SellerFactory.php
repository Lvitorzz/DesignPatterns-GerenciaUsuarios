<?php

require_once 'UserTypeFactory.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/models/Seller.php';

class SellerFactory implements UserTypeFactory {
    public function createUser($name, $email, $password, $document, $db) {
        return new Seller($db, $name, $email, $password, $document);
    }
}
?>