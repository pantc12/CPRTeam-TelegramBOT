<?php
set_time_limit(60);
date_default_timezone_set('Asia/Taipei');
header('Accept: application/json');
header('Content-Type: application/json; charset=utf-8');

include_once('commands.php');
include_once('tools.php');
include_once('api.php');

// Get Telegram hook POST Data
$json = file_get_contents('php://input') . PHP_EOL;
// Decode hook data from JSON to Array
$data = json_decode($json, true);

// Logging Hooks Data Raw
$time = date('Y-m-d H:i:s', time());
logging("hooks_raw", "<" . $time . ">");
logging("hooks_raw", $json . PHP_EOL);

// Logging Hooks Data Array
logging("hooks", "<" . $time . ">");
logging("hooks", $data . PHP_EOL);

// Initial Hook Variable
$updateID = $data['update_id'];
$messageID = $data['message']['message_id'];
$fromID = $data['message']['from']['id'];
$chatID = $data['message']['chat']['id'];
$date = $data['message']['date'];
$userName = $data['message']['from']['username'];
$message = $data['message']['text'];

// Initial DB Connection
try{
    if(file_exists('TelegramBOT.db')){
        $db = new SQLite3('TelegramBOT.db');
    }else{
        $error_msg = "Please Access https://" . $_SERVER['SERVER_NAME'] . "/install.php";
        logging("error", "<" . $time . ">" . PHP_EOL);
        logging("error", $error_msg);
        exit("Check error.log");
    }
}catch (Exception $exception) {
    $error_msg = $exception->getMessage();
    logging("error", "<" . $time . ">" . PHP_EOL);
    logging("error", $error_msg);
    exit("Check error.log");
}

// Initial Config
$config = array();
$query = $db->query("SELECT * FROM Config");
while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
    $config[$result["key"]] = $result["value"];
}

// Initial Users
$users = array();
$query = $db->query("SELECT * FROM Users");
$i = 0;
while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
    $users[$i]["uid"] = $result["uid"];
    $users[$i]["username"] = $result["username"];
    $i++;
}

// Initial WhiteList
$whiteList = array();
$query = $db->query("SELECT * FROM WhiteList");
$i = 0;
while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
    $whiteList[$i] = $result["uid"];
    $i++;
}

// Initial Help Command Content
$cmd_list = array(
    '/help - Show This Help',
    '/uptime - Show System Uptime',
    '/tagall - Tag ALL CPRTeam Staff',
    '/pull - Update BOT Program',
);

// Define Constant
define('BOT_TOKEN', $config["BOT_TOKEN"]);
define('BOT_USERNAME', $config["BOT_USERNAME"]);

// Main Program
if($userName != ""){
    // Auto Learning Users in Group
    if($chatID == $config["GroupID"]){
        $tmp = array();
        $query = $db->query("SELECT * FROM Users WHERE uid = '$fromID'");
        $i = 0;
        while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
            $tmp[$i]["uid"] = $result["uid"];
            $tmp[$i]["username"] = $result["username"];
            $i++;
        }
        if(count($tmp) == 0){
            $db->exec("INSERT INTO Users (uid, username) VALUES ('$fromID','$userName')");
        }else{
            $db->exec("UPDATE Users SET username = '$userName' WHERE uid = '$fromID'");
        }
    }

    // Command Handle
    if(substr($message, 0, 1) == "/"){
        if(in_array($fromID, $whiteList) || in_array($chatID, $whiteList)){
            $cmd = str_replace(strtolower("@" . BOT_USERNAME), '', strtolower($message));

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
