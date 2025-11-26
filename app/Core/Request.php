<?php

namespace App\Core;

use App\Core\Db;

class Request{
    public $post = [];
    public $get = [];
    public $server = [];
    public $cookie = [];
    public $files = [];

    public function __construct(){
        $this->post = $_POST;
        $this->get = $_GET;
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
        $this->files = $_FILES;
    }

    private static function escare($data){
        $result = [];
        foreach($data as $filed_name => $detail){
            if (!is_array($detail)) $result[$filed_name] = Db::escare($detail);
            else{
                $result[$filed_name] = self::escare($filed_name);
            }
            
        }
        return $result;
    }
}