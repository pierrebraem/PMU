<?php

class Controller{
    /* Affiche la vue demander
    Pamamètre d'entrée : nom du fichier à afficher
    Retourne : pas de retour
    */
    public static function index($vue){
        require_once 'views/'.$vue.'.php';
    }
}

?>