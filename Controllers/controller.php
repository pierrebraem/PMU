<?php
require_once './classes/connexionBDD.php';

class Controller extends BDD{
    public static function index($vue){
        require_once 'views/'.$vue.'.php';
    }
}

?>