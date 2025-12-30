<?php

namespace App\Core;

use App\Src\Controller;
use Error;
use Exception;
use App\Core\Config;
use App\Core\Request;

class Application{
    private $route;
    private $controller;
    private $method;
    private $config;


    public function __construct(){
        $this->route = new Router();
        $this->config = new Config; 
    }

    public function run(){

        try {
            session_start();
            $this->initController();
            $this->initMethod();
            $request = new Request(); 
            $content = $this->controller->{$this->method}($request);
            echo $content;

        } catch (Error $e){ __($e); die();
            __('404');
        }   
    }

    private function initController(){
        $class = $this->route->getControllerName();
        if (class_exists($class)) $this->controller = new $class();
    }

    private function initMethod(){
        $class = $this->route->getControllerName();
        $method = $this->route->getActionName(); 
        if (method_exists($class, $method . 'Action')) $this->method = $method. 'Action';
    }
    
}