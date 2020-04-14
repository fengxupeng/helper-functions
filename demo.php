<?php
require_once "./vendor/autoload.php";
use App\Curl;
use App\Components\Helper;


var_dump(Helper::microt());

$h = new Helper();
var_dump(get_class($h));
$c = new Curl();
var_dump(get_class($c));die;