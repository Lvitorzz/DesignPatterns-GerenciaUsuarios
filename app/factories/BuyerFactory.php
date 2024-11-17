<?php

require_once 'UserTypeFactory.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/models/Buyer.php';

class BuyerFactory implements UserTypeFactory {
    public function createUser($name, $email, $password, $document, $db) {
        return new Buyer($db, $name, $email, $password, $document);
    }
}
?>