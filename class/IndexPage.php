<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/22
 * Time: 9:45
 */

require_once 'Page.php';

class IndexPage implements Page
{
    public function getVariable()
    {
        require_once 'class/API.php';
    }

    public function getHtml()
    {
        $apiData = $this->getVariable();
//        require_once 'template/index.html';
        require_once 'template/index_detail.html';
    }
}