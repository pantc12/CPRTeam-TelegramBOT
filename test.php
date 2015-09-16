<?php

function test(){
    $fid = $GLOBALS['fromID'];
    $test = $GLOBALS['test'];
    if(in_array($fid, $test)){
        $p = rand(1, 100) % 5;
        $m = rand(1, 100) % 3;
        $msg = '';

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
            case 0:
                sendMsg($msg, false);
                break;
            
            default:
                break;
        }
    }
}

function test2(){
    $fid = $GLOBALS['fromID'];
    $test2 = $GLOBALS['test2'];
    if(in_array($fid, $test2)){
        $p = rand(1, 100) % 3;
        $m = rand(1, 100) % 1;
        $msg = '';

        switch ($m) {
            case 0:
                $msg = '阿不就好笑笑~ㄌㄩㄝ';
                break;

            default:
                break;
        }

        switch ($p) {
            case 0:
                sendMsg($msg, false);
                break;
            
            default:
                break;
        }
    }
}