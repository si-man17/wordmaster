<?php

namespace App\Core;

class Config{
    private  static $db_connect = [
        'localhost' => ['host' => 'mysql8.0', 'db_name' => 'wordmaster_db', 'user_name' => 'user_1', 'password' => 'password'],
        'domain' => []
    ];


    public function __construct(){
        define('SHOW_ERROR', true);
        define('DOCUMENT_ROOT', '/var/www/');

        $is_localhost = $this::isLocalHost();
        if ($is_localhost) define('ROOT_PATH', 'http://localhost:8000');
        else define('ROOT_PATH', 'https://domain');
    }

    public static function getDBdataConnect(){ 
        if (self::isLocalHost()) return self::$db_connect['localhost'];
        else return self::$db_connect['domain'];
    }

    public static function isLocalHost(){
        $result = false;
        if ($_SERVER['SERVER_NAME'] == 'localhost') $result = true;
        return $result;
    }
}