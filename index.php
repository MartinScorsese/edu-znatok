<?php
define('BASE_PATH', '/');

session_start();
require_once __DIR__.'/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path_parts = explode('/', $path);

$ctrl = !empty($path_parts[1]) ?  ucfirst($path_parts[1]) : 'Index';
$act = !empty($path_parts[2]) ?  ucfirst($path_parts[2]) : 'Show';

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
