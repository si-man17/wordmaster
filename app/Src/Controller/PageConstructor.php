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

    public function addToast($id, $message, $params){
        //// params = параметры из get по которым срабатывает уведомление
        $html = '<div class="toast-container position-fixed top-0 end-0 p-3">
                    <div id="'.$id.'" class="toast" role="alert">
                        <div class="toast-header">
                            <strong class="me-auto">Уведомление</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            '.$message.'
                        </div>
                    </div>
                </div>'; 
         
    }

    public static function genAuthPage(){
        $view = new View();
        return $view->render('form_auth.phtml');
    }
}