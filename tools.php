<?php

// Tools
function run_shell_cmd($cmd) {
    $msg = "";
    exec("$cmd", $output, $status);
    foreach($output as $line){
        $msg .= $line . PHP_EOL;
    }
    sendMsg($msg);
}
