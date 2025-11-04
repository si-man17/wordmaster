<?php

namespace App\Src\Controller;

class User{
    public function __construct(){

    }

    public static function checkLogin(){
        return false;
    }

    public function loginAction(){
        __('login2');
    }

    

}