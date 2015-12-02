<?php
set_time_limit(60);
date_default_timezone_set('Asia/Taipei');
header('Accept: application/json');

include_once('config.php');
include_once('logging.php');
include_once('commands.php');
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

if($userName != ""){
    if($chatID == -6205296){
        $db = new SQLite3('bot.db');
        $db->exec("CREATE TABLE IF NOT EXISTS `CPRTeam_STAFF` (
            `id`    INTEGER PRIMARY KEY AUTOINCREMENT,
            `uid`   TEXT NOT NULL,
            `username`  TEXT
        )");
        $query = $db->query("SELECT * FROM CPRTeam_STAFF WHERE uid = '$fromID'");
        $i = 0;
        $row = array();
        while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
            $row[$i]["uid"] = $result["uid"];
            $row[$i]["username"] = $result["username"];
            $i++;
        }
        if(count($row) == 0){
            $db->exec("INSERT INTO CPRTeam_STAFF (uid, username) VALUES ('$fromID','$userName')");
        }else{
            $db->exec("UPDATE CPRTeam_STAFF SET username = '$userName' WHERE uid = '$fromID'");
        }
    }

    if(substr($message, 0, 1) == "/"){
        if(in_array($fromID, $users) || in_array($chatID, $groups)){
            $cmd = str_replace(strtolower("@" . BOT_NAME), '', strtolower($message));

            switch ($cmd) {
                case "/help":
                    help();
                    break;

                case "/uptime":
                    uptime();
                    break;

                case "/tagall":
                    tagall();
                    break;

                case "/pull":
                    git_pull();
                    break;

                default:
                    break;
            }
        }else{
            sendMsg("你沒有權限喔~~~~~");
        }
    }
}
