<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 14:03
 */

defined('DEVELOPMENT') or define('DEVELOPMENT', 1);

if (DEVELOPMENT) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL ^ E_NOTICE);
} else {
    error_reporting(0);
}

$API_URL = '';