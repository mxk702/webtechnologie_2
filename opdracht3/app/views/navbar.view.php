<?php
$userController = new UsersContr();
$loggedIn = $userController->checkUserLoggedIn();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="./home">Shareboard</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link <?php if($page == 'home') echo 'active'?>" href="./home">Home</a></li>
            <li class="nav-item"><a class="nav-link <?php if($page == 'shares') echo 'active'?>" href="./shares">Shares</a></li>
            <?php if ($loggedIn): ?>
                <li class="nav-item"><a class="nav-link <?php if($page == 'account') echo 'active'?>" href="./account">My account</a></li>
                <li class="nav-item"><a class="nav-link" href="./logout">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link <?php if($page == 'login') echo 'active'?>" href="./login">Login</a></li>
                <li class="nav-item"><a class="nav-link <?php if($page == 'register') echo 'active'?>" href="./register">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>