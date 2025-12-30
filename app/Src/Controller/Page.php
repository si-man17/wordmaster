<?php

namespace App\Src\Controller;

use App\Core\Request;
use App\Src\Controller\PageConstructor;
use App\Core\Toast;
use App\Src\Model\User;
use App\Core\View;

class Page{
    private $header;
    private $footer;
    private $body;

    public function __construct(){
        $page_constr = new PageConstructor();
        $this->header = $page_constr->initHeader() . Toast::addHtmlJs();
        $this->body = $page_constr->generateBody();
        if (!User::isLoggin()) $this->body = '';

        $this->footer = $page_constr->initFooter(). Toast::show();
    }

    public function initAction(){
        $content = $this->header . $this->body. $this->footer;
        return $content;
    }

    public function loginAction(){
        $page_constr = new PageConstructor();
        return $page_constr->initLoginPage();
    }

    public function authPageAction(Request $request){

        $page = PageConstructor::genAuthPage();
        return $this->header . $page . $this->footer;
    }

    public function getWordslistAction(Request $request){ 
        $content = "";
        $view = new View();
        $content = $view->render('word_list.phtml', []);
        return $this->header . PageConstructor::genWordForm($content) . $this->footer;
    }

}