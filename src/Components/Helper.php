<?php

namespace App\Components;


class Helper
{
    /**
     * 生成一个不是很严谨的唯一标识
     * @return string
     */
    function createUniqid()
    {
        $str = md5(uniqid(mt_rand(), true));
        return $str;
    }


    /**
     * array -> json
     * @param $arr
     * @return false|string
     */
    public static function toJson($arr)
    {
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }


    /**
     * 四舍五入保留两位小数 返回浮点数)
     * @param $val
     * @param int $num
     * @return float
     */
    public static function roundVal($val, $num = 2)
    {
        return round($val, $num);
    }


    /**
     * @param $e
     * @return string debugmsg
     */
    public static function errorMsg($e)
    {
        $msg = $e->getMessage() . '|' . $e->getFile() . '|' . $e->getCode();
        return $msg;
    }

    /**
     * 年月日时分秒微秒毫秒
     * @return string
     */
    public static function microt()
    {
        $time = date('Y-m-d H:i:s') . ' ' . substr(explode(' ', microtime())[0], 2, 6);
        return $time;
    }

    /**
     * 主域名带协议
     * @return string
     */
    public static function domainUrl()
    {
        $url = self::ifHttps() . self::getDomain();
        return $url;
    }

    /**
     * 主域名
     */
    public static function getDomain()
    {
        $domain = $_SERVER['HTTP_HOST'];
        return $domain;
    }


    /**
     * 判断是否是https
     * @return string
     */
    public static function ifHttps()
    {
        if (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        )) {
            return 'https://';
        }
        return 'http://';
    }


    /**
     * 取指定字段的数组
     * @param $list
     * @param $field
     * @return array
     */
    public static function getIds($list, $field)
    {
        $arr = [];
        foreach ($list as $key => $val) {
            $arr[] = $val[$field];
        }

        return $arr;
    }

    /**
     * 多维数组处理
     * @param $datas
     * @param $field
     * @param bool $is_obj
     * @return array
     */
    public static function getColumn($datas, $field, $is_obj = true)
    {
        $temp = [];
        if ($is_obj) {
            foreach ($datas as $key => $val) {
                $temp[$val->$field] = $val;
            }
        } else {
            foreach ($datas as $key => $val) {
                $temp[$val[$field]] = $val;
            }
        }

        $datas = $temp;
        return $datas;
    }


    /**
     * 生成订单号
     * 年月日时分秒 + 微秒(6位) + 4位随机数
     * @param string $prefix
     * @return string
     */
    public static function makePaySn($prefix = '')
    {
        $mcro = explode(' ', microtime());
        $mcro = substr($mcro[0], 2, 6);
        $paySn = $prefix . Date('YmdHis') . $mcro . mt_rand(1000, 9999);
        return (string)$paySn;
    }


    /**
     * 格式化数组为字符串
     * @param array $value
     * @return string
     */
    public static function toCryptString($value)
    {
        $buff = "";
        foreach ($value as $k => $v) {
            $buff .= $k . "=" . $v . ",";
        }
        $buff = trim($buff, ",");
        return $buff;
    }

}
