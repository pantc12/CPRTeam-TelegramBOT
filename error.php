<?php

// Define Error Const
define('REQUEST_TIMEOUT', 1);
define('PERMISSION_ERROR', 2);
define('COMMAND_NOT_FOUND', 3);
define('BAD_PARAMETER', 4);

function error($id){
    switch ($id) {
        case REQUEST_TIMEOUT:
            $msg = '@' . $GLOBALS['userName'] . ': Request Timeout!!';
            sendMsg($msg);
            break;

        case PERMISSION_ERROR:
            $msg = '@' . $GLOBALS['userName'] . ': Permission Denied!!';
            sendMsg($msg);
            break;

        case COMMAND_NOT_FOUND:
            $msg = '@' . $GLOBALS['userName'] . ': Command Not Found!!';
            sendMsg($msg);
            break;

        case BAD_PARAMETER:
            $msg = '@' . $GLOBALS['userName'] . ': Bad Parameters!!';
            sendMsg($msg);
            break;

        default:
            $msg = '@' . $GLOBALS['userName'] . ': Unknown Error!!';
            sendMsg($msg);
            break;
    }
}
