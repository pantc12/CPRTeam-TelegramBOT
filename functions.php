<?php

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

function is_domain($d){
    $tlds = "/^[-a-z0-9]{1,63}\.(ac\.nz|co\.nz|geek\.nz|gen\.nz|kiwi\.nz|maori\.nz|net\.nz|org\.nz|school\.nz|ae|ae\.org|com\.af|asia|asn\.au|auz\.info|auz\.net|com\.au|id\.au|net\.au|org\.au|auz\.biz|az|com\.az|int\.az|net\.az|org\.az|pp\.az|biz\.fj|com\.fj|info\.fj|name\.fj|net\.fj|org\.fj|pro\.fj|or\.id|biz\.id|co\.id|my\.id|web\.id|biz\.ki|com\.ki|info\.ki|ki|mobi\.ki|net\.ki|org\.ki|phone\.ki|biz\.pk|com\.pk|net\.pk|org\.pk|pk|web\.pk|cc|cn|com\.cn|net\.cn|org\.cn|co\.in|firm\.in|gen\.in|in|in\.net|ind\.in|net\.in|org\.in|co\.ir|ir|co\.jp|jp|jp\.net|ne\.jp|or\.jp|co\.kr|kr|ne\.kr|or\.kr|co\.th|in\.th|com\.bd|com\.hk|hk|idv\.hk|org\.hk|com\.jo|jo|com\.kz|kz|org\.kz|com\.lk|lk|org\.lk|com\.my|my|com\.nf|info\.nf|net\.nf|nf|web\.nf|com\.ph|ph|com\.ps|net\.ps|org\.ps|ps|com\.sa|com\.sb|net\.sb|org\.sb|com\.sg|edu\.sg|org\.sg|per\.sg|sg|com\.tw|tw|com\.vn|net\.vn|org\.vn|vn|cx|fm|io|la|mn|nu|qa|tk|tl|tm|to|tv|ws|academy|careers|education|training|bike|biz|cat|co|com|info|me|mobi|name|net|org|pro|tel|travel|xxx|blackfriday|clothing|diamonds|shoes|tattoo|voyage|build|builders|construction|contractors|equipment|glass|lighting|plumbing|repair|solutions|buzz|sexy|singles|support|cab|limo|camera|camp|gallery|graphics|guitars|hiphop|photo|photography|photos|pics|center|florist|institute|christmas|coffee|kitchen|menu|recipes|company|enterprises|holdings|management|ventures|computer|systems|technology|directory|guru|tips|wiki|domains|link|estate|international|land|onl|pw|today|ac\.im|co\.im|com\.im|im|ltd\.co\.im|net\.im|org\.im|plc\.co\.im|am|at|co\.at|or\.at|ba|be|bg|biz\.pl|com\.pl|info\.pl|net\.pl|org\.pl|pl|biz\.tr|com\.tr|info\.tr|tv\.tr|web\.tr|by|ch|co\.ee|ee|co\.gg|gg|co\.gl|com\.gl|co\.hu|hu|co\.il|org\.il|co\.je|je|co\.nl|nl|co\.no|no|co\.rs|in\.rs|rs|co\.uk|org\.uk|uk\.net|com\.de|de|com\.es|es|nom\.es|org\.es|com\.gr|gr|com\.hr|com\.mk|mk|com\.mt|net\.mt|org\.mt|com\.pt|pt|com\.ro|ro|com\.ru|net\.ru|ru|su|com\.ua|ua|cz|dk|eu|fi|fr|pm|re|tf|wf|yt|gb\.net|ie|is|it|li|lt|lu|lv|md|mp|se|se\.net|si|sk|ac|ag|co\.ag|com\.ag|net\.ag|nom\.ag|org\.ag|ai|com\.ai|com\.ar|as|biz\.pr|com\.pr|net\.pr|org\.pr|pr|biz\.tt|co\.tt|com\.tt|tt|bo|com\.bo|com\.br|net\.br|tv\.br|bs|com\.bs|bz|co\.bz|com\.bz|net\.bz|org\.bz|ca|cl|co\.cr|cr|co\.dm|dm|co\.gy|com\.gy|gy|co\.lc|com\.lc|lc|co\.ms|com\.ms|ms|org\.ms|co\.ni|com\.ni|co\.ve|com\.ve|co\.vi|com\.vi|com\.co|net\.co|nom\.co|com\.cu|cu|com\.do|do|com\.ec|ec|info\.ec|net\.ec|com\.gt|gt|com\.hn|hn|com\.ht|ht|net\.ht|org\.ht|com\.jm|com\.kn|kn|com\.mx|mx|com\.pa|com\.pe|pe|com\.py|com\.sv|com\.uy|uy|com\.vc|net\.vc|org\.vc|vc|gd|gs|north\.am|south\.am|us|us\.org|sx|tc|vg|cd|cg|cm|co\.cm|com\.cm|net\.cm|co\.ke|or\.ke|co\.mg|com\.mg|mg|net\.mg|org\.mg|co\.mw|com\.mw|coop\.mw|mw|co\.na|com\.na|na|org\.na|co\.ug|ug|co\.za|com\.ly|ly|com\.ng|ng|com\.sc|sc|mu|rw|sh|so|st|club|kiwi|uno|email|ruhr)$/i";
    if (preg_match($tlds, $d)){
        return true;
    }else{
        return false;
    }
}

function run_shell_cmd($cmd) {
    exec("$cmd", $output, $status);
    foreach($output as $line){
        $msg .= $line . PHP_EOL;
    }
    sendMsg($msg);
}

function sendMsg($m, $is_reply = true){
    $cid = $GLOBALS['chatID'];
    $mid = $GLOBALS['messageID'];
    $m = urlencode($m);
    $url = "https://api.telegram.org/bot" . TOKEN . "/sendMessage?chat_id=" . $cid;
    if($is_reply){
        $url .= "&reply_to_message_id=" . $mid;
    }
    $url .= "&text=" . $m;
    $ch = curl_init($url);
    curl_exec($ch);
    curl_close($ch);
}

function error($id){
    switch ($id) {
        case 1:
            $msg = '@' . $GLOBALS['userName'] . ': Request Timeout!!';
            sendMsg($msg);
            break;

        case 2:
            $msg = '@' . $GLOBALS['userName'] . ': Permission Denied!!';
            sendMsg($msg);
            break;

        case 3:
            $msg = '@' . $GLOBALS['userName'] . ': Command Not Found!!';
            sendMsg($msg);
            break;

        case 4:
            $msg = '@' . $GLOBALS['userName'] . ': Bad Parameters!!';
            sendMsg($msg);
            break;
        
        default:
            $msg = '@' . $GLOBALS['userName'] . ': Unknown Error!!';
            sendMsg($msg);
            break;
    }
}

function logging($file, $d){
    $dump = print_r($d, true) . PHP_EOL;
    $filename = "./" . $file . ".log";
    $f = fopen($filename, 'a');
    fwrite($f, $dump);
    fclose($f);
}

function debug($d){
    logging("debug", $d);
}