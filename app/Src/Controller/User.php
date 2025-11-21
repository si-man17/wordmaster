<?php

namespace App\Src\Controller;

use App\Src\Controller\PageConstructor;
class User{
    public function __construct(){

    }

    public static function checkLogin(){
        return false;
    }

    public function loginAction(){
        $page_constr = new PageConstructor();
    }

    

}