<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/21
 * Time: 13:47
 */
if (is_file('class/config.php')) {
    include_once 'class/config.php';
} else {
    exit('NO CONFIGURE');
}
$_GP = array_merge($_GET, $_POST);
$do = $_GP['op'] ?: 'index';

switch ($do) {
    case 'index':
        include_once 'class/IndexPage.php';
        $indexPage = new IndexPage();
        $indexPage->getHtml();
        break;
    case 'index_submit':
        include_once 'class/IndexPage.php';
        $indexPage = new IndexPage();
        $indexPage->setVariable();
        break;
    default:
        exit('method not found');
        break;
}
exit;