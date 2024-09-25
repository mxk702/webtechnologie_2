<?php
    declare(strict_types = 1);
    require_once 'App.php';
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Transacties</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body class="d-flex flex-column h-100">
        <?php printNavbar('index'); ?>
        <main class="flex-shrink-0 mt-4 mb-4">
        <div class="container mt-5">
            <ul>
                <?php
                    $transactionFiles = getTransactionFiles();
                    foreach ($transactionFiles as $transactionFile) {
                        echo "<li><a href='./views/" . "transactions.php?file=" . $transactionFile . "'>" . $transactionFile . "</a></li>";
                    }
                ?>
            </ul>
        </div>
        </main>
    </body>
</html>