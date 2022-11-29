<?php

class Controller{
    public static function index($vue){
        require_once 'views/'.$vue.'.php';
        if(!empty($_SESSION)){
            var_dump($_SESSION);
        }
    }
}

?>