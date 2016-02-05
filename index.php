<?php
session_start();
require_once __DIR__.'/autoload.php';


$ctrl = isset($_GET['ctrl']) ? ucfirst($_GET['ctrl']) : 'Index';
$act = isset($_GET['act']) ? ucfirst($_GET['act']) : 'Show';


$controllerClassName = $ctrl . 'Controller';
$controller = new $controllerClassName;
$method = 'action' . $act;
$controller->$method();
