<?php

// Logging
function logging($file, $d){
    $dump = print_r($d, true) . PHP_EOL;
    $filename = "./" . $file . ".log";
    $f = fopen($filename, 'a');
    fwrite($f, $dump);
    fclose($f);
}

// Debug
function debug($d){
    logging("debug", $d);
}