<?php

spl_autoload_register('myAutoLoader');

function myAutoLoader ($className) {
    $path = 'app/classes/';
    $extension = '.class.php';
    $fileName = $path . $className . $extension;

    if (!file_exists($fileName)) {
      return false;
    }

    include_once $path . $className . $extension;
}
