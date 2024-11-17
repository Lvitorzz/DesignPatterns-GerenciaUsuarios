<?php

require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/BuyerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/SellerDeleteAccount.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/template/AbstractDeleteAccount.php';


class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $document;
    public $userType;


    public function __construct($db, $name = null, $email = null, $password = null, $document = null, $userType = null) {
        $this->conn = $db;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->document = $document;
        $this->userType = $userType;
    }

    public function createUser() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, password=:password, userType=:userType, document=:document";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->document = htmlspecialchars(strip_tags($this->document));
        $this->userType = htmlspecialchars(strip_tags($this->userType));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":document", $this->document);
        $stmt->bindParam(":userType", $this->userType);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function loginUser() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function updateUser() {
        if (!empty($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, password = :password WHERE id_user = :id_user";
        } else {
            $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email WHERE id_user = :id_user";
        }
    
        $stmt = $this->conn->prepare($query);
    
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id_user", $this->id);
    
        if (!empty($this->password)) {
            $stmt->bindParam(":password", $this->password);
        }
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    

    public function deleteUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
    
            $query = $this->conn->prepare("SELECT * FROM users WHERE id_user = ?");
            $query->execute([$_SESSION['user_id']]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
    
            if (!$user) {
                $error = "Usuário não encontrado!";
                require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/auth/delete.php';
                return;
            }
    
            if ($user['userType'] === 'vendedor') {
                $exclusao = new SellerDeleteAccount($this->conn, $user);
            } elseif ($user['userType'] === 'comprador') {
                $exclusao = new BuyerDeleteAccount($this->conn, $user);
            } else {
                $error = "Tipo de usuário inválido!";
                require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/auth/delete.php';
                return;
            }
    
            $resultado = $exclusao->excluirConta();
    
            if ($resultado === "Conta excluída com sucesso!") {
                session_destroy();
                header('Location: /GerenciaUsuario/public/login');
                exit();
            } else {
                $error = $resultado;
            }
        }
    
        require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/auth/delete.php';
    }

    public function getUsers($userStrategy) {
        if ($userStrategy) {    
            return $userStrategy->listarUsuarios($this->conn);
        } else {
            throw new Exception("Erro ao listar. Nenhuma estratégia definida.");
        }
    }

    public function getUserById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id_user", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>