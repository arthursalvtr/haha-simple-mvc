<?php
//入口文件
use App\Controller\HelloController;
define("APP_ROOT", __DIR__);
require APP_ROOT . '/vendor/autoload.php';
require_once APP_ROOT.'/core/bootstrap.php';

// function = 函数
// parameter = 参数
// passing by refference &$hi 引用传值
// passing by value $hi 传参
