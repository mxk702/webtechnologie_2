<?php
    include 'app/includes/class-autoload.inc.php';
    include 'app/classes/router.class.php';
    session_start();

    $router = new Router();

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // Routes registreren
    $router->addRoute('home', function() {
        include 'app/views/index.view.php';
    });

    $router->addRoute('shares', function() {
        include 'app/views/shares.view.php';
    });

    $router->addRoute('create', function() {
        include 'app/views/create.view.php';
    });

    $router->addRoute('login', function() {
        include 'app/views/login.view.php';
    });

    $router->addRoute('register', function() {
        include 'app/views/register.view.php';
    });

    $router->addRoute('logout', function() {
        include 'app/views/logout.view.php';
    });

    $router->addRoute('account', function() {
        include 'app/views/account.view.php';
    });

    $router->addRoute('delete_account', function() {
        $userController = new UsersContr();
        if ($userController->checkUserLoggedIn()) {
            $userController->removeUser();
        }
        header("Location: /home");
    });

    $router->addRoute('delete_share', function() {
        if (isset($_POST['share_id'])) {
            $userController = new UsersContr();
            if ($userController->checkUserLoggedIn()) {
                $sharesController = new SharesContr();
                $sharesController->removeShare($_POST['share_id']);
            }
        }
        header("Location: /shares");
    });

    $router->addRoute('update_share', function() {
        $sharesController = new SharesContr();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $shareId = $_POST['share_id'];
            $data = [
                'title' => $_POST['title'],
                'body'  => $_POST['body'],
                'link'  => $_POST['link']
            ];
            $sharesController->handleShareUpdate($shareId, $data);
        }

        // Else: GET
        else if (isset($_GET['share_id'])) {
            $shareId = $_GET['share_id'];
            $share = $sharesController->handleShareUpdate($shareId);
            include 'app/views/updateshare.view.php';
        }
    });

    // Run the router
    $router->run($page);
