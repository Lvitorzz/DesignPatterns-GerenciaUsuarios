<?php 
    interface UserTypeFactory {
        public function createUser($name, $email, $password, $document, $db);
    }
?>


