<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Share</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>
<body>
<?php include 'navbar.view.php'; ?>
<div class="container mt-4">
    <h2>Edit your share</h2>
    <form method="POST" action="">
        <input type='hidden' name='share_id' value=' <?php echo htmlspecialchars($share['id']); ?>'>
        <div class="form-group">
            <label for="title">Share title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($share['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea rows="4" name="body" class="form-control" required><?php echo htmlspecialchars($share['body']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" name="link" class="form-control" value="<?php echo htmlspecialchars($share['link']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Share</button>
        <a href="/shares" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
