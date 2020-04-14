<?php

namespace App;

use GuzzleHttp\Client;

/**
 * 依赖guzzle
 * Class Curl
 * @package app\common\logic
 */
class Curl
{

    /**
     * 请求数据json, 返回数组
     * @param $reqParams
     * @param $reqUrl
     * @return mixed
     */
    public static function curlByJson($reqParams, $reqUrl)
    {
        $client = new Client(['verify' => false]);
        $data = [
            'body' => json_encode($reqParams, JSON_UNESCAPED_UNICODE),
            'headers' => ['content-type' => 'application/json']
        ];

        $response = $client->post($reqUrl, $data);
        $contents = json_decode($response->getBody()->getContents(), true);
        return $contents;
    }

    /**
     * 请求数据json, 返回数组
     * @param $reqParams
     * @param $reqUrl
     * @return mixed
     */
    public static function curlByForm($reqParams, $reqUrl)
    {
        $client = new Client(['verify' => false]);
        $data['form_params'] = $reqParams;
        $response = $client->post($reqUrl, $data);
        $contents = json_decode($response->getBody()->getContents(), true);
        return $contents;
    }


    public static function curlByGet($reqUrl)
    {
        $client = new Client(['verify' => false]);
//        $data['form_params'] = $reqParams;
        $response = $client->get($reqUrl);
        $contents = json_decode($response->getBody()->getContents(), true);
        return $contents;
    }




    public static function curlByXml($url, $xmlData, $method = 1)
    {
        //-------- 发送xml数据 -------//
        $header = 'Content-type: text/xml;charset=utf-8';//定义content-type为xml
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$header]);//设置HTTP头
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);//全部数据使用HTTP协议中的"POST"操作来发送。

        $result = curl_exec($ch);//接收返回信息
        if (curl_errno($ch)) {
            curl_close($ch);
        }
        curl_close($ch);

        self::xmlToArray($result);


    }







}













