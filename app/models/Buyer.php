<?php 
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/models/User.php';
    class Buyer extends User {
        public function __construct($db, $name, $email, $password) {
            parent::__construct($db, $name, $email, $password, 'comprador');
        }
    }
?>