<?php

namespace App\Components;

/**
 * 正则表达式
 * Class Preg
 * @package App\Components
 */
class Preg
{

    /**
     * 以换行或回车分割字符串
     * @param $str
     * @return array[]|false|string[]
     */
    public function pregSplitStr($str)
    {
        return preg_split("/\\r|\\n/", $str);
    }

    /**
     * 返回匹配到的银行标识
     * @param $pattern string
     * @param $name
     * @return mixed
     */
    public static function getBankName($name, $pattern = "/(招商|工商|农业|中国银行|建设|交通|邮政|中信|光大|华夏|民生|广发|平安|兴业|浦发)/u")
    {
        if (preg_match($pattern, $name, $pregArr)) {
            return current($pregArr);
//            return $this->findModel(['like', 'bank_name', $pregArr[0]]);
        }
    }


    /**
     * 正则匹配一个非零正整数
     * @Author: FH
     * @param $val
     * @return bool
     */
    public static function positiveNoInclude0($val)
    {
        $pattern = '/^[1-9]\d*$/';
        return preg_match($pattern, $val);
    }


    /**
     * 正则匹配非负数
     * @Author: FH
     * @param $val
     * @return false|int
     */
    public static function nonnegativeNumber($val)
    {
        $p = '/^\d+(\.\d+)?$/';
        return preg_match($p, $val);
    }

    /**
     * 正则过滤vin码,初始为不存在车型
     * @param $vin
     * @return false|int
     */
    public static function vinCode($vin)
    {
        // 参考:https://stackoverflow.com/questions/30314850/vin-validation-regex
        $pattern = "/^[A-HJ-NPR-Za-hj-npr-z\\d]{8}[\\dX][A-HJ-NPR-Za-hj-npr-z\\d]{8}$/";//没有i,O,Q
        return preg_match($pattern, $vin);
    }

    /**
     * 正则验证正数
     * @param $val
     * @return false|int
     */
    public static function positiveNum($val)
    {
        $pattern = '/^[0-9]\d*$/';
        return preg_match($pattern, $val);
    }

    /**
     * 正则验证两位小数
     * 0 true 0.1 true 1.22 true 1.222 false 01 false 00 false
     * @param $val
     * @return bool
     */
    public static function positiveFloat2($val)
    {
        $pattern = "/^(?:[1-9]\d*|0)(?:\.\d{1,2})?$/";
        return preg_match($pattern, $val);
    }

    /**
     * 正则验证两位小数v2
     * 0 true 0.1 true 1 true 1.22 true 1.222 false 01 false 00 false
     * @param $val
     * @return bool
     */
    public static function positiveFloat2V2($val)
    {
        $pattern = "/^(0|[1-9]\d*)(\s|$|\.\d{1,2}\b)/";
        return preg_match($pattern, $val);
    }

    /**
     * 正则验证邮箱
     * @param $email
     * @return bool
     */
    function PregMatchEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * 正则验证邮箱
     * @param $email
     * @return bool
     */
    function PregMatchEmailV2($email){
        $patt = "/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/";
        $res = preg_match($patt, $email);
        return $res;
    }



    /**
     * 正则验证座机
     * @param $telephone
     * @return false|int
     */
    function pregMatchtelephone($telephone)
    {
        return preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/', $telephone);
    }

    /**
     * preg_match('/1[345789]\d{9}$/',$phone))
     * 正则验证手机号
     * @param $phone
     * @return false|int
     */
    public static function pregMatchphone($phone)
    {
        return preg_match('/^0?(13|15|17|18|19|14)[0-9]{9}$/', $phone);
    }

}