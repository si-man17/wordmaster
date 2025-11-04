<?php

namespace App\Core;

class View{
    private $template_path;
    private $data = [];

    public function __construct(){ 
        $this->template_path = DOCUMENT_ROOT;
    }

    public function render($tpl, $data = []){

        ob_start();/// поток ввода - вывода
        extract($data);
        $this->data += $data;

        include $this->template_path . 'app/Src/View'. '/' . $tpl;
        return ob_get_clean();
    }

    public function __get($var_name){
        return !empty($this->data[$var_name]) ? $this->data[$var_name]  : null;
    }
}