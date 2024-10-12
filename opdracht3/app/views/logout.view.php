<?php
    $userController = new UsersContr();
    $userController->signOutUser();
    // Naar loginpagina sturen
    header("Location: /login");
    exit();
?>