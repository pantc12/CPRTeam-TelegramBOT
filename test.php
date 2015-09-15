<?php

if(in_array($fromID, $test)){
    $p = rand(1, 100) % 10;
    $m = rand(1, 100) % 3;

    switch ($m) {
        case 0:
            $msg = '有雜訊!有雜訊!請重發!請重發!';
            break;

        case 1:
            $msg = '剛剛似乎有雜訊？Telegram又被攻擊了嗎？';
            break;

        case 2:
            $msg = '茲~茲~~茲~茲~~茲~茲~~';
            break;

        default:
            break;
    }

    switch ($p) {
        case 1:
            sendMsg($m, false);
            break;
        
        default:
            break;
    }
}