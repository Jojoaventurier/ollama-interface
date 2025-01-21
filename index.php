<?php
session_start();

// Enable error reporting for debugging during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Centralized error handler
function addError($message) {
    // Store errors in session for retrieval after redirection
    $_SESSION['errors'][] = $message;

    // Redirect to the referring page or a default page if referrer is not set
    $referrer = $_SERVER['HTTP_REFERER'] ?? '/';
    header("Location: $referrer");
    exit();
}

// Retrieve and clear errors for display on the current page
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

// Autoload controller classes or include them manually
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Routing logic
try {
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
            // Handle undefined routes
            header("HTTP/1.0 404 Not Found");
            echo "Page not found!";
            break;
    }
} catch (Exception $e) {
    // Log the exception and display a generic error message
    error_log('Error: ' . $e->getMessage());
    echo 'An unexpected error occurred. Please try again later.';
}
