<?php
$userController = new UsersContr();
$loggedIn = $userController->checkUserLoggedIn();
$current_url = $_SERVER['REQUEST_URI'];
$current_page = basename(parse_url($current_url, PHP_URL_PATH));
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./home">ShareBoard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link <?php if($current_page == 'home') echo 'active'?>" href="./home">Home</a></li>
            <li class="nav-item"><a class="nav-link <?php if($current_page == 'shares') echo 'active'?>" href="./shares">Shares</a></li>
            <?php if ($loggedIn): ?>
                <li class="nav-item">
                    <a href="./account" class="btn btn-outline-success">My account</a>
                </li>
                <li class="nav-item">
                    <a href="./logout" class="btn btn-outline-danger ml-lg-2 mt-2 mt-lg-0">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link <?php if($current_page == 'login') echo 'active'?>" href="./login">Login</a></li>
                <li class="nav-item"><a class="nav-link <?php if($current_page == 'register') echo 'active'?>" href="./register">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>