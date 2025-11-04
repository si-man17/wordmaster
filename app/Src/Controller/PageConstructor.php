<?php

namespace App\Src\Controller;
use App\Core\View;

class PageConstructor{
    public function initHeader(){
        $view = new View();
        return $view->render('header.phtml', []);    
    }

    public function initFooter(){
        $view = new View();
        return $view->render('footer.phtml', []);
    }
}