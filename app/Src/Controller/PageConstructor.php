<?php

namespace App\Src\Controller;
use App\Core\View;
use App\Src\Model\User;

class PageConstructor{
    public $header;
    public $footer;
    public $sidebar;

    public function __construct(){
        $this->header = $this->initHeader();
        $this->footer = $this->initFooter(); 
    }

    public function initLoginPage(){
        $view = new View();
        return $view->render('login.phtml', []);    
    }

    public static function genWordForm(String $content){
        $view = new View();
        return $view->render('body.phtml', ['content' => $content]);
    }
    
    public function initHeader(){
        $view = new View();
        $user = null;
        if (!empty($_SESSION) && !empty($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
        
        if (!empty($user_id))
            $user = User::getUserById($user_id); 

        return $view->render('header.phtml', ['user' => $user]);
    }

    public function initFooter(){
        $view = new View();
        return $view->render('footer.phtml', []);
    }

    public static function genAuthPage(){
        $view = new View();
        return $view->render('form_auth.phtml');
    }

    public function generateBody(){
        $view = new View();
        return $view->render('body.phtml');
    }
}