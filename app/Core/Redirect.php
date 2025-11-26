<?php

namespace App\Core;

use App\Core\Router;

class Redirect{
    private $url;
    private $get_params;
    private $get_str = "";
    private $headers;

    public function __construct($url){
        $this->url = ROOT_PATH . rtrim($url);
    }

    public function goTo($status_code=302){
        $this->url .= $this->get_str;
        header("Location: $this->url ", $status_code);
        exit();
    }

    public function prepareHeaders(){

    }

    public function prepareGet($params){
        $this->get_str = "";
        if (!empty($params))  $this->get_str .= '?';

        foreach($params as $par_key => $val){
            $this->get_str .= $par_key . '=' . $val . '&';    
        }
    }
}