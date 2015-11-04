<?php

// Stickers
function helpless(){
    $sid = "";
    $r = rand(1, 100) % 2;
    switch ($r) {
        case 0:
            $sid = "BQADBQADYAAD-hheAgABg2-XAQ3-7AI";
            break;

        case 1:
            $sid = "BQADBQADbAAD-hheAnxlkeFhv7A6Ag";
            break;

        default:
            $sid = "BQADBQADYAAD-hheAgABg2-XAQ3-7AI";
            break;
    }
    sendSticker($sid);
}

function eww(){
    $sid = "BQADBQADRwADzNLEA8x1FWTTTf0kAg";
    sendSticker($sid);
}

function mybad(){
    $sid = "BQADBQADXQADzNLEAxaoU9qjWGeBAg";
    sendSticker($sid);
}

function zzz(){
    $sid = "BQADBQADbwAD-hheAlEd1dYRPLKaAg";
    sendSticker($sid);
}

function kidding_me(){
    $sid = "BQADBQADdAAD-hheAkECocwnIoT7Ag";
    sendSticker($sid);
}

function ha(){
    $sid = "BQADBQADmAAD-hheAr5q8wj8BigKAg";
    sendSticker($sid);
}
