<?php

namespace App\Src\Controller;
use App\Core\View;

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
    
    public function initHeader(){
        $view = new View();
        return $view->render('header.phtml', []);    
    }

    public function initFooter(){
        $view = new View();
        return $view->render('footer.phtml', []);
    }

    public static function genAuthPage(){
        $view = new View();
        return $view->render('form_auth.phtml');
    }
}