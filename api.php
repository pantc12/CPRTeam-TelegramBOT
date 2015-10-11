<?php



// API
function sendMsg($m, $is_reply = true){
    sendChatAction("sendMsg");
    $cid = $GLOBALS['chatID'];
    $mid = $GLOBALS['messageID'];
    $m = urlencode($m);
    $url = "https://api.telegram.org/bot" . TOKEN . "/sendMessage?chat_id=" . $cid;
    $url .= "&disable_web_page_preview=true";
    if($is_reply){
        $url .= "&reply_to_message_id=" . $mid;
    }
    $url .= "&text=" . $m;
    $ch = curl_init($url);
    curl_exec($ch);

    $time = date('Y-m-d H:i:s', time());
    $log = curl_getinfo($ch);
    logging("request", "<" . $time . ">" . PHP_EOL);
    logging("request", $log);
    
    curl_close($ch);
}

function sendSticker($f, $is_reply = true){
    sendChatAction("sendSticker");
    $cid = $GLOBALS['chatID'];
    $mid = $GLOBALS['messageID'];
    $url = "https://api.telegram.org/bot" . TOKEN . "/sendSticker?chat_id=" . $cid;
    if($is_reply){
        $url .= "&reply_to_message_id=" . $mid;
    }
    $url .= "&sticker=" . $f;
    $ch = curl_init($url);
    curl_exec($ch);

    $time = date('Y-m-d H:i:s', time());
    $log = curl_getinfo($ch);
    logging("request", "<" . $time . ">" . PHP_EOL);
    logging("request", $log);
    
    curl_close($ch);
}

function sendVoice($v, $is_reply = true){
    sendChatAction("sendVoice");
    $cid = $GLOBALS['chatID'];
    $mid = $GLOBALS['messageID'];
    $url = "https://api.telegram.org/bot" . TOKEN . "/sendVoice?chat_id=" . $cid;
    if($is_reply){
        $url .= "&reply_to_message_id=" . $mid;
    }
    $url .= "&voice=" . $v;
    $ch = curl_init($url);
    curl_exec($ch);

    $time = date('Y-m-d H:i:s', time());
    $log = curl_getinfo($ch);
    logging("request", "<" . $time . ">" . PHP_EOL);
    logging("request", $log);
    
    curl_close($ch);
}

function sendChatAction($a){
    $cid = $GLOBALS['chatID'];
    $action = "";

    switch ($a) {
        case "sendMsg":
        case "sendSticker":
            $action = "typing";
            break;

        case "sendPhoto":
            $action = "upload_photo";
            break;

        case "sendVideo":
            $action = "upload_video";
            break;

        case "sendAudio":
        case "sendVoice":
            $action = "upload_audio";
            break;

        case "sendDoc":
            $action = "upload_document";
            break;

        default:
            $action = "typing";
            break;
    }

    $url = "https://api.telegram.org/bot" . TOKEN . "/sendChatAction?chat_id=" . $cid;
    $url .= "&action=" . $action;
    $ch = curl_init($url);
    curl_exec($ch);

    $time = date('Y-m-d H:i:s', time());
    $log = curl_getinfo($ch);
    logging("request", "<" . $time . ">" . PHP_EOL);
    logging("request", $log);
    
    curl_close($ch);
}