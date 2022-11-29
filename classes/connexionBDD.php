<?php
class BDD{
    private static function connexion(){
        try{
            return new PDO('mysql:host=localhost;dbname=pmu;charset=utf8', 'admin', 'admin');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }

    public static function requete($requete, $params = array()){
        $connexion = self::connexion()->prepare($requete);
        $connexion->execute($params);
        if(explode(' ', $requete)[0] == 'SELECT'){
            return $connexion->fetchAll();
        }
    }
}

?>