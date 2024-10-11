<?php
$userController = new UsersContr();
if ($userController->checkUserLoggedIn()) {
    header("Location: /home"); // Als al ingelogd --> Naar home sturen
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Login the user
    if ($userController->signInUser($email, $password)) {
        header("Location: /home");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareBoard - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.view.php'; ?>
    <?php include 'registrationalert.view.php'; ?>
    <?php include 'loginalert.view.php'; ?>
    <?php include 'logoutalert.view.php'; ?>
    <div class="container mt-5">
        <h2>User Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
