<?php
session_start();
header('Content-Type:text/html;charset=utf-8');

use application\controllers\RouteController;

function autoloadMainClasses($class_name){
    $class_name = str_replace('\\','/', $class_name);

    if(!@include_once $class_name . '.php'){
        throw new \Exception('Не верное имя файла для подключения - ' .$class_name);
    }

}

spl_autoload_register('autoloadMainClasses');
try {
    $front = RouteController::getInstance();
    $front->route();
    echo $front->getBody();
}
catch (Exception $e) {
        exit($e->getMessage());
    }