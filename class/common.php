<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/22
 * Time: 13:41
 */

function message($msg, $type = 'error', $redirect = '')
{
    $successAutoNext = true;
    if ($type == 'redirect') {
        if (empty($msg) && !empty($redirect)) {
            header('Location: ' . $redirect);
        }
        exit;
    } else {
        require_once 'template/message.html';
        exit;
    }
}