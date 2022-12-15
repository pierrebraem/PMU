<?php
class Route{
    public static $routes = array();

    /* Vérifie si la route existe et exécute la fonction mise en paramètre
    Pamamètres d'entrée : la route demandée, la fonction à exécuter
    Retourne : pas de retour
    */
    public static function set($route, $fonction){
        self::$routes[] = $route;
        
        /* Si la route existe exécuter la fonction en paramètre */
        if($_GET['url'] == $route){
            $fonction->__invoke();
        }
    }
}
?>