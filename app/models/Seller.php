<?php 
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/models/User.php';
    class Seller extends User {
        public function __construct($db, $name, $email, $password) {
            parent::__construct($db, $name, $email, $password, 'vendedor');
        }
    }
?>