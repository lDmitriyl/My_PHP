<?php
session_start();
require 'application/lib/Dev.php';
use application\core\Router;

//require 'application/core/Loader.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}

//$load=new Loader();
//
//spl_autoload_register([$load,'loadClass']);
spl_autoload_register(function($class) {
    $path = dirname(__FILE__).'/'.strtolower(str_replace('\\', '/', $class.'.php'));
    if (file_exists($path)) {
        require $path;
    }
});

$front = new Router();
$front->route();
