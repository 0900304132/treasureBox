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
        // TODO: Implement getVariable() method.
    }

    public function getHtml()
    {
        require_once 'template/index.html';
    }
}