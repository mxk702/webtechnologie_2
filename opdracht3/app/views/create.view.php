<?php

if (!isset($_SESSION['userid'])) {
    header("Location: /login"); // Als niet ingelogd --> Naar loginpagina sturen
    exit();
}

// Wordt de pagina geladen met POST-methode, dan hebben we een formulier (share) om te verwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $link = $_POST['link'];
    $userId = $_SESSION['userid'];

    $sharesController = new SharesContr();
    $sharesController->createNewShare($title, $body, $link, $userId);
    header("Location: /shares");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Share</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.view.php'; ?>

<div class="container mt-4">
    <h2>Share Something!</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="title">Share Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" name="link" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="./shares" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
