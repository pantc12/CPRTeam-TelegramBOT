<?php

// Commands
function help(){
    $msg = "Available Commands: " . PHP_EOL;
    foreach ($GLOBALS['cmd_list'] as $cmd_desc) {
        $msg .= "$cmd_desc" . PHP_EOL;
    }
    sendMsg($msg);
}

function uptime(){
    run_shell_cmd("timeout 30 /usr/bin/uptime");
}

function git_pull(){
    run_shell_cmd("timeout 30 git pull");
}

function tagall(){
    $db = new SQLite3('bot.db');
    $query = $db->query("SELECT username FROM CPRTeam_STAFF");
    $i = 0;
    $row = array();
    while ($result = $query->fetchArray(SQLITE3_ASSOC)) {
        $row[$i++]["username"] = $result["username"];
    }
    $msg = "";
    for ($i = 0; $i < count($row); $i++){
        if($row[$i]['username'] != $GLOBALS['userName']){
            $msg .= "@" . $row[$i]['username'] . " ";
        }
    }
    sendMsg($msg);
}
