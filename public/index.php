<?php
require_once '../config/database.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/IndexController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/GerenciaUsuario/public/':
        $authController = new AuthController();
        $authController->login();
        break;

    case '/GerenciaUsuario/public/login':
        $authController = new AuthController();
        $authController->login();
        if (isset($_SESSION['user_id'])) {
            header('Location: /GerenciaUsuario/public/home');
        }
        break;

    case '/GerenciaUsuario/public/register':
        $authController = new AuthController();
        $authController->register();
        break;

    case '/GerenciaUsuario/public/logout':
        $authController = new AuthController();
        $authController->logout();
        break;

    case '/GerenciaUsuario/public/home':
        $indexController = new IndexController();
        $indexController->index();
        break;

    case '/GerenciaUsuario/public/list':
        $indexController = new IndexController();
        $indexController->read();
        break;

    case '/GerenciaUsuario/public/painel':
        $indexController = new IndexController();
        $indexController->painel();
        break;

    case '/GerenciaUsuario/public/edit':
        $indexController = new IndexController();
        $indexController->edit();
        break;

    case '/GerenciaUsuario/public/delete':
        $indexController = new IndexController();
        $indexController->delete();
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo "Página não encontrada!";
        break;
}