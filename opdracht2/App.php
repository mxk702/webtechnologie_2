<?php

declare(strict_types = 1);

/*  __DIR__ werkt niet voor wat we hier willen bereiken want dan krijg je de parent directory
    Dus: __FILE__ gebruiken */
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('CSS_PATH', $root . 'css' . DIRECTORY_SEPARATOR);

function printNavbar(string $currentPage) {
    echo '<header>
              <nav class="navbar navbar-expand-md fixed-top" style="background-color: #e3f2fd;">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link '; if($currentPage=='index') echo 'active '; echo '" aria-current="page" href="'; if($currentPage=='index') echo '#'; else echo '../index.php'; echo '">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link '; if($currentPage=='transacties') echo 'active '; else echo 'disabled '; echo '" href="./transacties.php" tabindex="-1" aria-disabled="true">Transacties</a>
                      </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="https://www.youtube.com/watch?v=xvFZjo5PgG0"><button type="button" class="btn btn-primary">Login</button></a></li>
                    </ul>
                  </div>
                </div>
              </nav>
            </header>';
}

// Lijst van transactiebestanden returnen
function getTransactionFiles(): array {
    $files = scandir(FILES_PATH);
    return array_filter($files, function($file) {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'csv';
    });
}

// Inhoud van één transactiebstand returnen
function getTransactionFileData(string $fileName): array {
    $filedata = [];
    $filepath = FILES_PATH . $fileName;

    try {
        $file = fopen($filepath, "r");
        if(!$file) {
            return $filedata;
        }
        else {
            $firstline = fgets($file);
            $headers = str_getcsv($firstline, "\t");
            if(sizeof($headers) == 4) {
                while (($row = fgetcsv($file, 1000, "\t")) !== false) {
                    $data = [];
                    for ($i = 0; $i < count($headers); $i++) {
                        if (strtolower($headers[$i]) == 'bedrag') {
                            $data[$headers[$i]] = str_replace(",", ".", $row[$i]);
                        } else {
                            $data[$headers[$i]] = $row[$i];
                        }
                    }
                    $filedata[] = $data;
                }
                fclose($file);
                return $filedata;
            }
        }
    }
    catch (\Exception $e) {
        return $filedata;
    }
    return $filedata;
}

function formatDate(string $date): string
{
    // php gaat er bij strtotime vanuit dat Amerikaanse mm/dd wordt gebruikt als er een slash (/) wordt gebruikt
    // wanneer er een dash (-) wordt gebruikt, gaat php uit van dd/mm. We moeten dus slashes vervangen door dashes, als die er zijn
    $date = str_replace('/', '-', $date);
    // en nu kunnen we de presentatie van de string wijzigen
    return date('j F Y', strtotime($date));
}

function getCellColorByAmount(float $amount): string
{
    if($amount > 0){
        return "80af81"; // groen
    }
    else return "d38686"; // rood
}

function printFooter()
{
    echo '<footer class="fixed-bottom mt-auto bg-dark">
                <div class="container">
                    <p class="text-center text-white mt-3">September 2024 - Student 353268</p>
                </div>
          </footer>';
}

function includeBootstrapAndCss()
{
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';
    echo '<link rel="stylesheet" href="..\css\styling.css">';
}

function includeJs()
{
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>';
}