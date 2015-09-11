<?php
set_time_limit(60);
date_default_timezone_set('Asia/Taipei');
header('Accept: application/json');

include_once('config.php');
include_once('functions.php');

// Get Telegram Hooks POST Data
$json = file_get_contents('php://input') . PHP_EOL;
$data = json_decode($json, true);

// Logging Hooks Data Raw
$time = date('Y-m-d H:i:s', time());
logging("hooks_raw", "<" . $time . ">" . PHP_EOL);
logging("hooks_raw", $json);

// Logging Hooks Data Array
logging("hooks", "<" . $time . ">" . PHP_EOL);
logging("hooks", $data);

// Global Variable
$updateID = $data['update_id'];
$messageID = $data['message']['message_id'];
$fromID = $data['message']['from']['id'];
$chatID = $data['message']['chat']['id'];
$date = $data['message']['date'];
$userName = $data['message']['from']['username'];
$message = $data['message']['text'];

if($userName != ""){                            // Check isset username
    if(substr($message, 0, 1) == "/"){          // Check is command
        if(in_array($fromID, $users) || in_array($chatID, $groups)){          // Check White List
            $message = strtolower($message);
            $cmd = str_replace(strtolower("@" . BOT_NAME), '', $message);
            $cmd = split(' ', $cmd);

            switch ($cmd[0]) {
                case "/ping":
                    if(count($cmd) == 2){
                        ping($cmd[1]);  
                    }else{
                        error(4);
                    }
                    break;

                case "/ping6":
                    if(count($cmd) == 2){
                        ping6($cmd[1]); 
                    }else{
                        error(4);
                    }
                    break;

                case "/traceroute":
                    if(count($cmd) == 2){
                        traceroute($cmd[1]);
                    }else{
                        error(4);
                    }
                    break;

                case "/traceroute6":
                    if(count($cmd) == 2){
                        traceroute6($cmd[1]);
                    }else{
                        error(4);
                    }
                    break;
                
                case "/nslookup":
                    if(count($cmd) == 3){
                        nslookup($cmd[1], $cmd[2]);
                    }if(count($cmd) == 2){
                        nslookup($cmd[1]);
                    }else{
                        error(4);
                    }
                    break;

                case "/whois":
                    if(count($cmd) == 2){
                        whois($cmd[1]);
                    }else{
                        error(4);
                    }
                    break;

                case "/help":
                    help();
                    break;

                case "/search":
                    if(count($cmd) == 3){
                        search($cmd[1], $cmd[2]);
                    }else{
                        error(4);
                    }
                    break;
                
                default:
                    if(strpos($message, "@" . BOT_NAME)){
                        sendMsg("我沒這指令, 你想做什麼??");
                    }
                    break;
            }
        }else{
            error(2);
        }
    }else{
        if(strpos($message, "@" . BOT_NAME) !== false){
            sendMsg("嗨~ Tag 我幹嘛?");
        }
        
        preg_match('/無.*奈.*/', $message);
        if(preg_match('/無.*奈.*/', $message) === 1){
            helpless();
        }

        if(preg_match('/矮.*額.*/', $message) === 1){
            eww();
        }

        if(preg_match('/怪.*我.*囉.*/', $message) === 1){
            mybad();
        }
    }
}