<?php

function __autoload($class)
{
    if (file_exists(__DIR__. '/controllers/' . $class . '.php')){
        require __DIR__. '/controllers/' . $class . '.php';
    }elseif (file_exists(__DIR__. '/classes/' . $class . '.php')){
        require __DIR__. '/classes/' . $class . '.php';
    }elseif (file_exists(__DIR__. '/models/' . $class . '.php')){
        require __DIR__. '/models/' . $class . '.php';
    }elseif (file_exists(__DIR__. '/../controllers/' . $class . '.php')){
        require __DIR__. '/../controllers/' . $class . '.php';
    }elseif (file_exists(__DIR__. '/../classes/' . $class . '.php')){
        require __DIR__. '/../classes/' . $class . '.php';
    }elseif (file_exists(__DIR__. '/../models/' . $class . '.php')){
        require __DIR__. '/../models/' . $class . '.php';
    }else{
        header('HTTP/1.1 404 Not Found');
        //include 'search.php'; // or 404.php whatever you want...
        exit();
    }
}