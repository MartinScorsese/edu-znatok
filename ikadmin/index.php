<?php
define('BASE_PATH', '/');
define('ADMIN_PATH', '/ikadmin/');

session_start();
require_once __DIR__.'/autoload.php';


$ctrl = isset($_GET['ctrl']) ? ucfirst($_GET['ctrl']) : 'Index';
$act = isset($_GET['act']) ? ucfirst($_GET['act']) : 'Show';
$controllerClassName = $ctrl . 'Controller';

try{
    
    $controller = new $controllerClassName;
    $method = 'action' . $act;
    $controller->$method();
}catch (Exception $e) {
    
    $view = new View();
    $view->error = $e->getMessage();
    $view->code = $e->getCode();
    $view->display('errors/errors.php');
}