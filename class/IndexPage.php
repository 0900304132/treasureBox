<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/22
 * Time: 9:45
 */

require_once 'Page.php';

/**
 * Class IndexPage
 */
class IndexPage implements Page
{
    /**
     * IndexPage constructor.
     */
    function __construct()
    {
        require_once 'class/API.php';
    }

    /**
     * 获取首页数据
     * @return mixed|stdClass
     */
    public function getVariable()
    {
        global $_GP;
        $result = API::getResult('/bbxorder/getGoodsByQR', array(
            'qrContent' => $_GP['qrContent'],
        ));
        if ($result->code == '000000') {
            return $result;
        } else {
            message($result->info);
        }
    }

    /**
     * 设置用户收货信息
     */
    public function setVariable()
    {
        global $_GP;
        $para = array(
            'receiver' => $_GP['receiver'],
            'phone' => $_GP['phone'],
            'province' => $_GP['province'],
            'city' => $_GP['city'],
            'area' => $_GP['area'],
            'address' => $_GP['address'],
            'qrContent' => $_GP['qrContent'],
        );
        API::getJsonResult('/bbxorder/addOrder', $para);
    }

    /**
     *  获取html
     */
    public function getHtml()
    {
        $apiData = $this->getVariable();
        $orderStatus = $apiData->data->orderStatus;
        $goodsInfo = $apiData->data->goodsInfo;
        if ($orderStatus == 2) {
            $orderInfo = $apiData->data->orderInfo;
            require_once 'template/index_detail.html';
        } else {
            require_once 'template/index.html';
        }
    }
}