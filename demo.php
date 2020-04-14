<?php
require_once "./vendor/autoload.php";
use App\Curl;


$h = new \App\components\Helper();
var_dump(get_class($h));
$c = new Curl();
var_dump(get_class($c));die;