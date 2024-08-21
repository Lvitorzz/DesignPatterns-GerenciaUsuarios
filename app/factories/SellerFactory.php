<?php

require_once 'UserTypeFactory.php';

class SellerFactory implements UserTypeFactory {
    public function createUser($name, $email, $password, $db) {
        return new User($db, $name, $email, $password, 'comprador');
    }
}
?>