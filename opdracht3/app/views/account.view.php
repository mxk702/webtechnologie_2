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
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>