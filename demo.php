<?php
require_once "./vendor/autoload.php";

use App\Curl;
use App\Components\Helper;

//var_dump(\App\Components\Helper::convertDecimal(12.6, 0));
//die;


function positiveFloat2($val)
{
    $pattern = "/^(?:[1-9]\d*|0)(?:\.\d{1,2})?$/";
    return preg_match($pattern, $val);
}

//var_dump(positiveFloat2("1.3e"));
//var_dump(positiveFloat2("1.39"));die;

/**
 * 0 true 0.1 true 1 true 1.22 true 1.222 false 01 false 00 false
 * @param $val
 * @return bool
 */
function positiveFloat2V2($val)
{
    $pattern = "/^(0|[1-9]\d*)(\s|$|\.\d{1,2}\b)/";
    return preg_match($pattern, $val);
}
var_dump(positiveFloat2V2("1.3e"));
var_dump(positiveFloat2V2("0.88"));die;
//var_dump(sprintf("%1\$u",$number));die;
//$number = 123.9;
//$txt = sprintf("带有两位小数：%1\$.2f
//<br>不带小数：%1\$u",$number);
//echo $txt;

//
//var_dump(Helper::numberFormatVal(123.945));die;
//var_dump(Helper::roundVal(123.945));die;
//var_dump(Helper::convertDecimal(123.945), 2);
//var_dump(Helper::convertDecimal(123.946), 2);
//var_dump(Helper::convertDecimal(123.947), 2);die;
//var_dump(Helper::microt());
//
//$h = new Helper();
//var_dump(get_class($h));
//$c = new Curl();
//var_dump(get_class($c));die;