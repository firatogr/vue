<?php

    $route = array_values(array_filter(explode('/', explode('?', explode('/vue/', mb_strtolower($_SERVER['REQUEST_URI'], 'UTF-8'), 2)[1])[0])));

    error_reporting(E_ALL);
    ini_set('display_errors', true);

    ob_start();
    session_start();
    date_default_timezone_set('Europe/Istanbul');

    foreach(glob('helpers/*.php') as $file) require $file;

    spl_autoload_register(function($class){
        if(!file_exists($path = 'classes/' . $class . '.php')){
            return;
        }
        require $path;
    });

    define('URL', 'http://localhost/vue/');

    //$db = new basicdb('localhost', 'app', 'root', '');

    if(!isset($route[0])){
        $route[0] = 'index';
    } elseif(!file_exists('controllers/' . $route[0] . '.php')){
        $route[0] = '404';
    }

    require 'controllers/' . $route[0] . '.php';
    
?>