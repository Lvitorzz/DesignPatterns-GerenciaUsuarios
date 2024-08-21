<?php
// Inicializar o sistema e roteamento
require_once '../config/database.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/IndexController.php';

// Obter a URL solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Roteamento básico
switch ($uri) {
    case '/GerenciaUsuario/public/':
        $authController = new AuthController();
        $authController->login();
        break;

    case '/GerenciaUsuario/public/login':
        $authController = new AuthController();
        $authController->login();
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