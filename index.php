<?php
session_start();

// Centralized error handler
function addError($message) {
    $_SESSION['errors'][] = $message;
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page
    exit();
}

// Retrieve and clear errors for display
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

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