<?php

namespace App\Components;

class Validate
{
    /**
     * @param $keys array 字段一维数组
     * @param $data array 所接受的一维数组
     * @param string $msg 自定义错误消息
     * @param int $code 自定义错误码
     * @throws \Exception
     */
    public static function validate($keys, $data, $msg = '', $code = 4040)
    {
        foreach ($keys as $val) {
            if (!isset($data[$val]) || empty($data[$val])) {
                if (empty($msg)) {
                    $msg = '缺少参数:' . $val;
                }
                throw new \Exception($msg, $code);
            }
        }
    }

}