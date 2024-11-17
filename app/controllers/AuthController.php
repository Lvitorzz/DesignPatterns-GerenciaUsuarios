<?php
require_once '../config/database.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/models/User.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/factories/UserTypeFactory.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/factories/SellerFactory.php';
require_once 'C:/xampp/htdocs/GerenciaUsuario/app/factories/BuyerFactory.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        session_start();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];
            

            $user = $this->user->loginUser();

            if ($user) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['document'] = $user['document'];
                $_SESSION['userType'] = $user['userType'];
                header('Location: /GerenciaUsuario/public/home');
            } else {
                $error = "Credenciais inválidas!";
            }
        }
        require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $document = $_POST['document'];
            $userType = $_POST['userType'];
    
            if ($userType === 'vendedor') {
                $factory = new SellerFactory();
            } elseif ($userType === 'comprador') {
                $factory = new BuyerFactory();
            } else {
                $error = "Tipo de usuário inválido!";
                require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/auth/register.php';
                return;
            }
    
            $this->user = $factory->createUser($name, $email, $password, $document, $this->db);
    
            if ($this->user->createUser()) {
                header('Location: /GerenciaUsuario/public/login');
                exit();
            } else {
                $error = "Erro ao criar conta!";
            }
        }
    
        require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /GerenciaUsuario/public/login');
    }
}
?>