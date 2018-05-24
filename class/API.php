<?php

/**
 * 接口类
 * Class API
 */
class API
{
    /**
     * 调用接口
     * @param string $sub_path 接口方法地址
     * @param array $data 接口参数
     * @param string $type 服务器处理或者ajax处理
     * @return mixed|stdClass 接口数据
     */
    public static function getResult($sub_path, $data, $type = 'service')
    {
        require_once 'SignMD5.php';
        global $API_URL;

        $data = SignMD5::createSign($data);
        $result = API::http_post($API_URL . $sub_path, http_build_query($data));
        if ($result) {
            $result_obj = json_decode($result);
            if ($result_obj->code == '00000') {
                return $result_obj;
            } else {
                if ($type == 'ajax') {
                    return $result_obj;
                }
                if (DEVELOPMENT) {
                    echo $API_URL . $sub_path . '<br>';
                    var_dump($data);
                    var_dump($result_obj);
                    exit;
                } else {
                    message($result_obj->info);
                }
            }
        } else {
            $result_obj = new stdClass();
            $result_obj->code = '99999';
            $result_obj->info = '调用接口失败';
            return $result_obj;
        }
    }

    /**
     * 返回接口的 json 数据
     * @param $sub_path
     * @param $data
     * @param string $type
     */
    public static function getJsonResult($sub_path, $data, $type = 'ajax')
    {
        die(json_encode(self::getResult($sub_path, $data, $type)));
    }

    /**
     * post发送数据
     * @param string $url 发送地址
     * @param string $post_data 发送的数据
     * @return mixed 返回数据
     */
    public static function http_post($url, $post_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}