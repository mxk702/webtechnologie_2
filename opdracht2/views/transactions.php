<?php

declare(strict_types = 1);
require_once '../App.php';

$csvFileName = $_GET['file'];
if (empty($_GET['file'])) $transactions = [];
else $transactions = getTransactionFileData($csvFileName);

$totalIncome = 0;
$totalExpenses = 0;
$netTotal = 0;

?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Transacties</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body class="d-flex flex-column h-100">
    <?php printNavbar('transacties'); ?>
        <div class="container-md mt-5">
        <?php if (count($transactions) > 0) { ?>
        <table class="mt-3">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Check #</th>
                    <th>Beschrijving</th>
                    <th>Bedrag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($transactions as $transaction) {
                        echo "<tr>";
                        echo "<td>" . $transaction['datum'] . "</td>";
                        echo "<td>" . $transaction['checksum'] . "</td>";
                        echo "<td>" . $transaction['beschrijving'] . "</td>";
                        echo "<td>" . $transaction['bedrag'] . "</td>";
                        echo "</tr>";

                        if ($transaction['bedrag'] > 0) {
                            $totalIncome += $transaction['bedrag'];
                        }
                        else {
                            $totalExpenses += abs((float) $transaction['bedrag']);
                        }
                    $netTotal = $totalIncome - $totalExpenses;
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Totale Inkomsten:</th>
                    <td><?php echo number_format($totalIncome, 2); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Totale Uitgaven:</th>
                    <td><?php echo number_format($totalExpenses, 2); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Netto totaal:</th>
                    <td><?php echo number_format($netTotal, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        </div>
    <?php }
        else {
                echo '<div class="alert alert-danger" role="alert">' .
                    '<p>The following file could not be opened or processed:</p>' .
                    '<p><b>' . FILES_PATH . $csvFileName . '</b></p>' .
                    '<p>This could have one of the following reasons:</p>' .
                    '<ul>' .
                    '<li>The file does not exist.</li>' .
                    '<li>The file is not a tab-delimited .csv file. A tab-delimited .csv file uses "\t" to separate values from each other.</li>' .
                    '<li>The file is corrupted, contains unnecessary extra characters and/or contains an inconsistent amount of delimiters per row.</li>' .
                    '</ul>' .
                    '</div>';
            }
    ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
