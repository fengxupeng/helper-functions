<?php

namespace App\Components;

class Preg
{

    public function pregMatchphone($phone)
    {
        return preg_match('/^0?(13|15|17|18|19|14)[0-9]{9}$/', $phone);
    }
}