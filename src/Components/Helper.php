<?php

namespace App\Components;


class Helper
{
    /**
     * 生成一个不是很严谨的唯一标识
     * @return string
     */
    public static function createUniqid()
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
     * 舍掉小数,不四舍五入
     * eg: 12.99 -> 12
     * @param $num
     * @return string
     */
    public static function toInt($num)
    {
        return sprintf("%u", $num);
    }


    /**
     * (不推荐)四舍五入保留两位小数,返回浮点数(string)
     * ***注意: 12.555 -> 12.55 , 12.556 -> 12.56
     * @Author: FH
     * @param $amount
     * @param int $num
     * @return string
     */
    public static function convertDecimal($amount, $num = 2)
    {
        $ret = sprintf('%.' . $num . 'f', $amount);
        return $ret;
    }


    /**
     * 四舍五入保留两位小数,返回浮点数(float)
     * @param $val
     * @param int $num
     * @return float
     */
    public static function roundVal($val, $num = 2)
    {
        return round($val, $num);
    }


    /**
     * 四舍五入,返回浮点数字符串(string)
     * @param $val
     * @param int $num
     * @return string
     */
    public static function numberFormatVal($val, $num = 2)
    {
        $formattedNum = number_format($val, $num, '.', '');
        return $formattedNum;
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
     * 根据自定义错误码打印自定义错误信息
     * @param $e
     * @param string $msg
     * @param int $code
     * @return string
     */
    public static function errMsg($e, $msg = 'error', $code = 4040)
    {
        if (method_exists($e, 'getCode') && method_exists($e, 'getMessage')) {
            if ($e->getCode() == $code) {
                $msg = $e->getMessage();
            }
        }
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
     * 判断是否是https(SSL协议)
     * @return string
     */
    public static function ifHttps()
    {

        //
//        if (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
//            return 'https://';
//        }

        if (((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ||
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
     * example: www.url.com?key=google&time=2000
     * 转换成 ["key" => "baidu", "time" => 2000]
     * url 解析
     * todo 也可以参考: http_build_query 和 parse_str
     * @param $str
     * @param string $separator
     * @return array
     */
    public function parseUrl($str, $separator = "?")
    {
        $data = [];
        $str = explode($separator, $str);
        $paramArr = explode('&', end($str));
        foreach ($paramArr as $val) {
            $tmp = explode('=', $val);
            $data[current($tmp)] = end($tmp);
        }
        return $data;
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
     * xml转换数组
     * @param $response
     * @return mixed
     */
    public static function xmlToArray($response)
    {
        $xmlstring = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring), true);

        return $val;
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
