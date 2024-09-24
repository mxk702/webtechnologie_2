<?php

declare(strict_types = 1);

/*  __DIR__ werkt niet voor wat we hier willen bereiken want dan krijg je de parent directory
    Dus: __FILE__ gebruiken */
$root = dirname(__FILE__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);

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
            throw new Exception("Unable to open the file" . $filepath);
        }
        else {
            $headers = fgetcsv($file, 1000, "\t"); // get the headers
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
        }
    }
    catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    return $filedata;
}
