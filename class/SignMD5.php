<?php

/**
 * 接口签名类
 * Class SignMD5
 */
class SignMD5
{
    /**
     * 创建签名
     * @param $params
     * @return mixed
     */
    static public function createSign($params)
    {
        $params['timePoint'] = time();
        $str = self::createLinkString($params);
        $params['sign'] = self::createSign0($str);
        return $params;
    }

    /**
     * md5签名
     * @param $params
     * @return string
     */
    static public function createSign0($params)
    {
        global $apiSignKey;
        return md5($params . $apiSignKey);
    }

    /**
     * 创建签名字符串
     * @param $params
     * @return string
     */
    static public function createLinkString($params)
    {
        $result = "";
        ksort($params, SORT_STRING);
        foreach ($params as $key => $v) {
            if ("sign" == $key) {
                continue;
            }
            $val = urlencode($v);
            $result .= "{$key}=\"{$val}\"&";
        }
        $result = rtrim($result, '&');
        return $result;
    }
}