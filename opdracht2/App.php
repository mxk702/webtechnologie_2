<?php

declare(strict_types = 1);

/*  __DIR__ werkt niet voor wat we hier willen bereiken want dan krijg je de parent directory
    Dus: __FILE__ gebruiken */
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);

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

// Returns a list of transaction files
function getTransactionFiles(): array {
    $files = scandir(FILES_PATH);
    return array_filter($files, function($file) {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'csv';
    });
}

// Returns the content of a transaction file
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


