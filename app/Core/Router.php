<?php

namespace App\Core;



class Router {
    public static $params = [];
    private $controller_name;
    private $action_name;
    private $is_process = false;

    private $static_routes = [
        '/user/login/' => ['class'=> 'User', 'action' => 'login'],
        'page404' => ['class' => 'Page', 'action' => '404'],
        '/' => ['class' => 'Page', 'action' => 'init']
    ];


    public function process(){ ///// тут добавить сборку параметров с get и post, а так же сразу экранирование!!!
        
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $parts_first = explode('/', $path);
        $parts = array_diff($parts_first, ['']);

        if (!array_key_exists($path, $this->static_routes)){
            $this->controller_name = 'App\Src\Controller\\' .  ucwords($parts[1]);
            $this->action_name = $parts[count($parts)];
        } else {
            $this->controller_name = 'App\Src\Controller\\' .  ucwords($this->static_routes[$path]['class']);
            $this->action_name = $this->static_routes[$path]['action'];
        }

        $this->is_process = true;
    }

    public function getControllerName(){
        if (!$this->is_process) $this->process();
        return $this->controller_name;
    }


    public function getActionName(){
        if (!$this->is_process) $this->process();
        return $this->action_name;
    }

}
