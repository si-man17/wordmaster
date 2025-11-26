<?php

namespace App\Src\Controller;

use App\Core\Request;
use App\Src\Controller\PageConstructor;
use App\Core\Toast;

class Page{
    private $header;
    private $footer;

    public function __construct(){
        $page_constr = new PageConstructor();
        $this->header = $page_constr->initHeader() . Toast::addHtmlJs();
        $this->footer = $page_constr->initFooter(). Toast::show();
    }

    public function initAction(){
        $content = $this->header . $this->footer;
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
}