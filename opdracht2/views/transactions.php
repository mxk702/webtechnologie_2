<?php

declare(strict_types = 1);
require_once '../App.php';

$csvFileName = $_GET['file'];
$transactions = getTransactionFileData($csvFileName);

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
    </head>
    <body>
        <table>
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
    </body>
</html>
