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
</head>
<body>
<?php include 'navbar.view.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">All Shares</h2>
    <?php if ($loggedIn): ?>
        <a href="/create" class="btn btn-success mb-4">Share Something</a>
    <?php endif; ?>

    <?php if (!empty($allShares)): ?>
        <?php  $sharesView->showAllShares($allShares);?>
    <?php else: ?>
        <p class="alert alert-info">No shares found.</p>
    <?php endif; ?>
</div>
</body>
</html>