<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';

class IndexController {
    private $db;
    private $user;
    private $users;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
        }
    }

    public function index() {
        require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/home.php';
    }

    public function read() {
        $users = $this->user->getUsers();
        require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/list.php';
    }

    public function edit() {
        $this->user->id = $_SESSION['user_id'];
        $user = $this->user->getUserById();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if ($this->user->updateUser()) {
                $_SESSION['user_name'] = $this->user->name;
                header('Location: /GerenciaUsuario/public/home');
                
            }
        }
        require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/edit.php';
    }

    public function delete() {
        $this->user->id = $_SESSION['user_id'];
        if ($this->user->deleteUser()) {
            session_destroy();
            header('Location: /GerenciaUsuario/public/delete');
        }
    }
}
?>