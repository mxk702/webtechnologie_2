<?php
    declare(strict_types = 1);
    require_once 'App.php';
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Transacties</title>
    </head>
    <body>
        <ul>
            <?php
                $transactionFiles = getTransactionFiles();
                foreach ($transactionFiles as $transactionFile) {
                    echo "<li><a href='./views/" . "transactions.php?file=" . $transactionFile . "'>" . $transactionFile . "</a></li>";
                    echo print_r(getTransactionFileData($transactionFile));
                }
            ?>
        </ul>
    </body>
</html>