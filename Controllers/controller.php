<?php

class Controller{
    public static function index($vue){
        require_once 'views/'.$vue.'.php';
    }
}

?>