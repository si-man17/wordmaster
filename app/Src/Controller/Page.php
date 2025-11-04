<?php

namespace App\Src\Controller;

use App\Src\Controller\PageConstructor;

class Page{
    private $header;
    private $footer;


    public function __construct(){
        $page_constr = new PageConstructor();
        $this->header = $page_constr->initHeader();
        $this->footer = $page_constr->initFooter();
    }


    public function initAction(){
        $content = $this->header . $this->footer;
        return $content;
    }
}