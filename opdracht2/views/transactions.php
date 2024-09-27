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
        <?php includeBootstrapAndCss(); ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php printNavbar('transacties'); ?>
    <?php if (count($transactions) > 0) { ?>
            <div class="container-md mt-3">
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
                        echo "<td>" . formatDate($transaction['datum']) . "</td>";
                        echo "<td>" . $transaction['checksum'] . "</td>";
                        echo "<td>" . $transaction['beschrijving'] . "</td>";
                        echo "<td bgcolor='" . getCellColorByAmount((float) $transaction['bedrag']) . "'>" . $transaction['bedrag'] . "</td>";
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
                echo '<div class="container-md mt-3">' .
                        '<div class="alert alert-danger" role="alert">' .
                            '<p>Het volgende bestand kon niet worden geopend:</p>' .
                            '<p><b>' . FILES_PATH . $csvFileName . '</b></p>' .
                            '<p>Dit kan één van de volgende redenen hebben:</p>' .
                            '<ul>' .
                            '<li>Het bestand bestaat niet.</li>' .
                            '<li>De waarden in het .csv-bestand zijn niet gescheiden door middel van tabs ("\t").</li>' .
                            '<li>Het bestand is corrupt, bevat onnodige extra karakters zoals " of bevat een inconsistent aantal delimiters ("\t") per regel.</li>' .
                            '</ul>' .
                        '</div>' .
                    '</div>';
            }
    ?>
    <?php includeJs(); ?>
    </body>
    <!-- Footer afdrukken -->
    <?php printFooter(); ?>
</html>
