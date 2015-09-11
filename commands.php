<?php

// Commands
function ping($host){
    if( filter_var($host, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($host), FILTER_VALIDATE_IP) ||
        is_domain($host)){
        run_shell_cmd("timeout 30 /bin/ping -c 4 $host");
    }else{
        error(4);
    }
}

function ping6($host){
    if( filter_var($host, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($host), FILTER_VALIDATE_IP) ||
        is_domain($host)){
        run_shell_cmd("timeout 30 /bin/ping6 -c 4 $host");
    }else{
        error(4);
    }
}

function traceroute($host){
    if( filter_var($host, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($host), FILTER_VALIDATE_IP) ||
        is_domain($host)){
        run_shell_cmd("timeout 30 /usr/bin/traceroute -n -w 15 $host | grep -vi '* * *'");
    }else{
        error(4);
    }
}

function traceroute6($host){
    if( filter_var($host, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($host), FILTER_VALIDATE_IP) ||
        is_domain($host)){
        run_shell_cmd("timeout 30 /usr/bin/traceroute6 -n -w 15 $host | grep -vi '* * *'");
    }else{
        error(4);
    }
}

function nslookup($host, $server = "8.8.8.8"){
    if( (filter_var($host, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($host), FILTER_VALIDATE_IP) ||
        is_domain($host)) &&
        (filter_var($server, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($server), FILTER_VALIDATE_IP) ||
        is_domain($server)) ){
        run_shell_cmd("timeout 30 /usr/bin/nslookup $host $server");
    }else{
        error(4);
    }
}

function whois($host){
    if( filter_var($host, FILTER_VALIDATE_IP) || 
        filter_var(gethostbyname($host), FILTER_VALIDATE_IP) ||
        is_domain($host)){
        run_shell_cmd("timeout 30 /usr/bin/whois $host");
    }else{
        error(4);
    }
}

function help(){
    $msg = "Available Commands: " . PHP_EOL;
    foreach ($GLOBALS['cmd_list'] as $cmd_desc) {
        $msg .= "$cmd_desc" . PHP_EOL;
    }
    sendMsg($msg);
}

function burn(){
    $vid = "AwADBQADCwAD5Bf9B8FIuhQiaDILAg";
    sendVoice($vid);
}

function helpless(){
    $sid = "";
    $r = rand(1, 100) % 2;
    switch ($r) {
        case 0:
            $sid = "BQADBQADYAAD-hheAgABg2-XAQ3-7AI";
            break;

        case 1:
            $sid = "BQADBQADbAAD-hheAnxlkeFhv7A6Ag";
            break;
        
        default:
            $sid = "BQADBQADYAAD-hheAgABg2-XAQ3-7AI";
            break;
    }
    sendSticker($sid);
}

function eww(){
    $sid = "BQADBQADRwADzNLEA8x1FWTTTf0kAg";
    sendSticker($sid);
}

function mybad(){
    $sid = "BQADBQADXQADzNLEAxaoU9qjWGeBAg";
    sendSticker($sid);
}