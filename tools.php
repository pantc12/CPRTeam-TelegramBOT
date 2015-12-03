<?php

// Run Shell Command
function run_shell_cmd($cmd) {
    $msg = "";
    exec("timeout 60 $cmd", $output, $status);
    foreach($output as $line){
        $msg .= $line . PHP_EOL;
    }
    sendMsg($msg);
}

// Logging
function logging($file, $d){
    $dump = print_r($d, true) . PHP_EOL;
    $filename = "./" . $file . ".log";
    $f = fopen($filename, 'a');
    fwrite($f, $dump);
    fclose($f);
}
