<?php

namespace App\Components;

class Preg
{

    /**
     * 验证手机号
     * @param $phone
     * @return false|int
     */
    public static function pregMatchphone($phone)
    {
        return preg_match('/^0?(13|15|17|18|19|14)[0-9]{9}$/', $phone);
    }
}