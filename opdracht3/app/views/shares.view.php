<?php
    $sharesController = new SharesContr();
    $sharesView = new SharesView();
    $allShares = $sharesController->fetchAllShares();
    $userController = new UsersContr();
    $loggedIn = $userController->checkUserLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareBoard - Shares</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>
<body>
<?php include 'navbar.view.php'; ?>
<?php include 'alerts/sharesalert.view.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">All shares</h2>
    <?php if ($loggedIn): ?>
        <a href="/create" class="btn btn-success mb-4">Share something</a>
    <?php endif; ?>
    <?php if (!empty($allShares)): ?>
        <?php  $sharesView->showAllShares($allShares);?>
    <?php else: ?>
        <p class="alert alert-info">No shares found.</p>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>