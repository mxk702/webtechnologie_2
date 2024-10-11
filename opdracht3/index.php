<?php
// Include the autoloader
include 'app/includes/class-autoload.inc.php';
session_start();

// Achterhalen welke pagina we willen tonen op basis van de page-parameter. Is die er niet, dan altijd home tonen
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Serveren van de juiste paginaview
switch ($page) {
    case 'home':
        include 'app/views/index.view.php';
        break;
    case 'shares':
        include 'app/views/shares.view.php';
        break;
    case 'create':
        include 'app/views/create.view.php';
        break;
    case 'login':
        include 'app/views/login.view.php';
        break;
    case 'register':
        include 'app/views/register.view.php';
        break;
    case 'logout':
        include 'app/views/logout.view.php';
        break;
    case 'account':
        include 'app/views/account.view.php';
        break;
    case 'delete_account':
        $userController = new UsersContr();
        if (!$userController->checkUserLoggedIn()) {
            include 'app/views/index.view.php';
        }
        $userController->removeUser();
        include 'app/views/index.view.php';
        break;
    case 'delete_share':
        if(isset($_POST['share_id'])) {
            $sharesController = new SharesContr();
            $sharesController->removeShare($_POST['share_id']);
        }
        header("Location: /shares");
        break;
    default:
        include 'app/views/404.view.php';
        break;
}