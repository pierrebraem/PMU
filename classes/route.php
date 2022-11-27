<?php
class Route{
    public static $routes = array();

    public static function set($route, $fonction){
        self::$routes[] = $route;
        
        if($_GET['url'] == $route){
            $fonction->__invoke();
        }
    }
}
?>