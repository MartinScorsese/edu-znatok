<?php
define('BASE_PATH', '/');

session_start();
require_once __DIR__.'/autoload.php';


$ctrl = isset($_GET['ctrl']) ? ucfirst($_GET['ctrl']) : 'Index';
$act = isset($_GET['act']) ? ucfirst($_GET['act']) : 'Show';
$controllerClassName = $ctrl . 'Controller';

try{
    
    $controller = new $controllerClassName;
    $method = 'action' . $act;
    if(method_exists($controller, $method)){
        $controller->$method();
    }else{
        throw new ControllerException('Метода <b>' . $method . '</b> в контроллере <b>' . $controllerClassName . '</b> не существует', '404');
    }  
}catch (Exception $e) {
    
    $view = new View();
    $view->error = $e->getMessage();
    $view->code = $e->getCode();
    $view->display('errors/errors.php');
}
