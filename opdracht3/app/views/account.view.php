<?php
$userController = new UsersContr();
if (!$userController->checkUserLoggedIn()) {
    header("Location: /home"); // Als niet ingelogd --> Naar home sturen
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareBoard - Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.view.php'; ?>
<div class="container mt-4">
    <div class="jumbotron text-center">
        <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
        <p><b>Your registered email address: </b><?php echo $_SESSION['email']; ?></p>
        <p><b>You joined this website on: </b><?php echo $_SESSION['register_date']; ?></p>
        <p>If you would like to delete your account, you can click on the button below. We would be sad to see you go!<br>
            Deleting your account also deletes all shares you have created.</p>
        <!-- Account verwijderen knop/form -->
        <form action="/delete_account" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <button class="btn btn-danger" type="submit">Delete Account</button>
        </form>
    </div>
</div>
</body>
</html>