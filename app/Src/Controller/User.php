<?php

namespace App\Src\Controller;

use App\Core\Request;
use App\Src\Controller\PageConstructor;
use App\Src\Model\User as UserModel;
use App\Core\Redirect;
use App\Core\Toast;

class User{
    public function __construct(){

    }

    public static function checkLogin(){
        return false;
    }

    public function loginAction(Request $request){
        $auth = UserModel::loginAuth($request->post);
        $redirect = new Redirect('/');
        
        if ($auth){
            Toast::add('Добро пожаловать, ' . $auth->name. ' ' . $auth->surname, 'info');
        } else Toast::add('Пользователь не найден', 'info');
        $redirect->goTo('200');
    }

    public function registerUserAction(Request $request){
        $check_user = UserModel::checkUserExist($request->post);
        if (!$check_user){
            UserModel::insertUser($request->post);
            $redirect = new Redirect('/user/auth/');
            Toast::add('Пользвоатель добавлен');
            $redirect->goTo(200);
        } else {
            $redirect = new Redirect('/user/auth/');
            Toast::add('Такой пользователь уже существует');
            $redirect->goTo(200);
        }
        
    }

}