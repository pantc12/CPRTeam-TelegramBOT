<?php
date_default_timezone_set('Asia/Taipei');
header('Content-Type: text/html; charset=utf-8');

if(isset($_POST['BOT_TOKEN']) && isset($_POST['BOT_USERNAME']) && isset($_POST['GroupID']) ){
    try{
        $db = new SQLite3('TelegramBOT.db', SQLITE3_OPEN_CREATE|SQLITE3_OPEN_READWRITE);
    }catch (Exception $exception){
        $error_msg = $exception->getMessage();
        logging("error", "<" . $time . ">");
        logging("error", $error_msg . PHP_EOL);
        exit("Check error.log");
    }

    // Create Users
    $db->exec("CREATE TABLE IF NOT EXISTS `Users` (
        `id`    INTEGER PRIMARY KEY AUTOINCREMENT,
        `uid`   TEXT NOT NULL,
        `username`  TEXT,
        `comment`   TEXT
    )");

    // Create WhiteList
    $db->exec("CREATE TABLE IF NOT EXISTS `WhiteList` (
        `id`    INTEGER PRIMARY KEY AUTOINCREMENT,
        `uid`   INTEGER NOT NULL,
        `comment`   TEXT
    )");

    // Create Groups
    $db->exec("CREATE TABLE IF NOT EXISTS `Groups` (
        `id`    INTEGER PRIMARY KEY AUTOINCREMENT,
        `name`  TEXT NOT NULL,
        `comment`   TEXT,
        `uid`   INTEGER NOT NULL
    )");

    // Create Config
    $db->exec("CREATE TABLE IF NOT EXISTS `Config` (
        `id`    INTEGER PRIMARY KEY AUTOINCREMENT,
        `key`   TEXT,
        `value` TEXT
    )");
    $bot_token = $_POST['BOT_TOKEN'];
    $bot_username = $_POST['BOT_USERNAME'];
    $groupid = $_POST['GroupID'];
    $db->exec("INSERT INTO Config (key, value) VALUES ('BOT_TOKEN', '$bot_token')");
    $db->exec("INSERT INTO Config (key, value) VALUES ('BOT_USERNAME', '$bot_username')");
    $db->exec("INSERT INTO Config (key, value) VALUES ('GroupID', '$groupid')");

    echo "Warning!";
    echo "<h1><font color='red'>Please remove install.php</font></h1>";
    echo "Warning!";
}else{
    echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="POST">';
    echo 'BOT_TOKEN:<br>';
    echo '<input type="text" name="BOT_TOKEN">';
    echo '<br>';
    echo 'BOT_USERNAME:<br>';
    echo '<input type="text" name="BOT_USERNAME">';
    echo '<br>';
    echo 'GroupID:<br>';
    echo '<input type="text" name="GroupID">';
    echo '<br>';
    echo '<input type="submit" value="Submit">';
    echo '</form>';
}
// BOT_TOKEN
// BOT_USERNAME
// GroupID
