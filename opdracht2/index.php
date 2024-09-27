<?php
    declare(strict_types = 1);
    require_once 'App.php';
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Transacties</title>
        <?php includeBootstrapAndCss(); ?>
    </head>
    <body class="d-flex flex-column h-100">
        <!-- Afdrukken van de navbar, meegeven welke pagina we ons nu op bevinden -->
        <?php printNavbar('index'); ?>
        <main class="flex-shrink-0 mb-4">
            <div class="container mt-5 text-center">
                <h4>Welkom op deze website!</h4>
                <p>Hieronder vindt u enkele transactiebestanden. Klik op een bestand om de transacties te raadplegen.</p>
                <p>Misschien doet één van de bestanden het niet. Dat komt dan doordat het bestand niet juist is ingedeeld.</p>
                <hr>
            </div>
            <div class="container text-center">
                <!-- Lijst met transactiebstanden tonen -->
                    <?php
                        $transactionFiles = getTransactionFiles();
                        foreach ($transactionFiles as $transactionFile) {
                            echo "<p><b>Bestand:</b> <a href='./views/" . "transactions.php?file=" . $transactionFile . "'>" . $transactionFile . "</a></p>";
                        }
                    ?>
                <hr>
            </div>
            <!-- Carousel met fraaie afbeeldingen -->
            <div class="container w-50">
                <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="6000">
                            <img src="./images/image1.jpg" class="d-block w-100">
                        </div>
                        <div class="carousel-item" data-bs-interval="6000">
                            <img src="./images/image2.jpg" class="d-block w-100">
                        </div>
                        <div class="carousel-item" data-bs-interval="6000">
                            <img src="./images/image3.jpg" class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </main>
        <?php includeJs(); ?>
        </body>
    <!-- Footer afdrukken -->
    <?php printFooter(); ?>
</html>