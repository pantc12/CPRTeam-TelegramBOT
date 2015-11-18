<?php
set_time_limit(60);
date_default_timezone_set('Asia/Taipei');
header('Accept: application/json');

include_once('config.php');
include_once('logging.php');
include_once('error.php');
include_once('commands.php');
include_once('stickers.php');
include_once('tools.php');
include_once('api.php');

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
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/ping6":
                    if(count($cmd) == 2){
                        ping6($cmd[1]);
                    }else{
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/traceroute":
                    if(count($cmd) == 2){
                        traceroute($cmd[1]);
                    }else{
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/traceroute6":
                    if(count($cmd) == 2){
                        traceroute6($cmd[1]);
                    }else{
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/nslookup":
                    if(count($cmd) == 3){
                        nslookup($cmd[1], $cmd[2]);
                    }if(count($cmd) == 2){
                        nslookup($cmd[1]);
                    }else{
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/whois":
                    if(count($cmd) == 2){
                        whois($cmd[1]);
                    }else{
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/help":
                    help();
                    break;

                case "/search":
                    if(count($cmd) == 3){
                        search($cmd[1], $cmd[2]);
                    }else{
                        error(BAD_PARAMETER);
                    }
                    break;

                case "/burn":
                case "/燒毀":
                    burn();
                    break;

                case "/uptime":
                    uptime();
                    break;

                case "/tagall":
                    tagall();
                    break;

                default:
                    if(strpos($message, "@" . BOT_NAME)){
                        sendMsg("我沒這指令, 你想做什麼??");
                    }
                    break;
            }
        }else{
            error(PERMISSION_ERROR);
        }
    }else{
        if(strpos($message, "@" . BOT_NAME) !== false){
            sendMsg("嗨~Tag我幹嘛?");
        }

        if(preg_match('/無.*奈.*/', $message) === 1){
            helpless();
        }

        if(preg_match('/矮.*額.*/', $message) === 1){
            eww();
        }

        if(preg_match('/怪.*我.*囉.*/', $message) === 1){
            mybad();
        }

        if(preg_match('/[Zz][Zz][Zz]/', $message) === 1){
            zzz();
        }

        if(preg_match('/別.*鬧.*了.*/', $message) === 1){
            kidding_me();
        }

        if(preg_match('/蛤.*/', $message) === 1){
            ha();
        }

        if(preg_match('/ㄏㄚˊ.*/', $message) === 1){
            ha();
        }

        if($chatID == -6205296){
            $db = new SQLite3('bot.db');
            $db->exec("CREATE TABLE IF NOT EXISTS `CPRTeam_STAFF` (
                `id`    INTEGER PRIMARY KEY AUTOINCREMENT,
                `uid`   TEXT NOT NULL,
                `username`  TEXT
            )");
            $query = $db->query("SELECT * FROM CPRTeam_STAFF WHERE username = '$userName'");
            $i = 0;
            $row = array();
            while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
                $row[$i]["uid"] = $result["uid"];
                $row[$i]["username"] = $result["username"];
                $i++;
            }
            if(count($row) == 0){
                $db->exec("INSERT INTO CPRTeam_STAFF (uid, username) VALUES ('$fromID','$userName')");
            }
        }

    }
}
