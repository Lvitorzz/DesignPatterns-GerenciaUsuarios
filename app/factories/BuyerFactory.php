<?php

require_once 'UserTypeFactory.php';

class BuyerFactory implements UserTypeFactory {
    public function createUser($name, $email, $password, $db) {
        return new User($db, $name, $email, $password, 'vendedor');
    }
}

?>