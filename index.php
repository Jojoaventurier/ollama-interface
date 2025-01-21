<?php
session_start();

if (!empty($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo 'An error occurred. Unable to redirect.';
    exit();
}

require_once 'database.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/ModelController.php';
require_once 'controllers/ConversationController.php';

$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'models':
        $controller = new ModelController();
        $controller->listModels();
        break;
    case 'download':
        $controller = new ModelController();
        $controller->download();
        break;
    case 'conversations':
        $controller = new ConversationController();
        $controller->listConversations();
        break;
    default:
        echo "Page not found!";
        break;
}