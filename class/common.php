<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/22
 * Time: 13:41
 */

function message($msg, $type = 'error', $redirect = '')
{
    if ($type == 'redirect') {
        if (empty($msg) && !empty($redirect)) {
            header('Location: ' . $redirect);
        }
        exit;
    } else {
        require_once 'tempalte/message.html';
        exit;
    }
}