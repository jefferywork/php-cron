<?php
require 'vendor/autoload.php';

const ROOT_PATH = __DIR__ . '/';
date_default_timezone_set('Asia/Shanghai');

$class = ucfirst($argv[1] ?? null);
$method = $argv[2] ?? null;
$classController = 'Jefferywork\\PhpCron\\Controllers\\' . $class . 'Controller';

if (!class_exists($classController)) {
    throw new Exception("类 {$classController} 不存在");
}

if(empty($method)) {
    $method = 'index';
}

if(!method_exists($classController, $method)) {
    throw new Exception("方法 {$classController}::{$method} 不存在");
}

(new $classController)->$method();
