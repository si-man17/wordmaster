<?php

namespace App\Src\Controller;
use App\Core\Request;
use App\Src\Model\Word as WordModel;

class Word{
    public function __construct(){}

    public function addWordAction(Request $request){
        $word = new WordModel($request);
    }
    
}