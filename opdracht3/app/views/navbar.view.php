<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Shareboard</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="?page=home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=shares">Shares</a></li>
            <?php if (isset($_SESSION['userid'])): ?>
                <li class="nav-item"><span class="nav-link">Welcome <?php echo htmlspecialchars($_SESSION['name']); ?></span></li>
                <li class="nav-item"><a class="nav-link" href="?page=logout">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="?page=login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=register">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>