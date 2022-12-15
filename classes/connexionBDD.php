<?php
class BDD{
    /* Gestion de la connexion avec la BDD 
    Pamamètre d'entrée : aucun
    Retourne : les informations de connexion à la BDD
    */
    private static function connexion(){
        try{
            return new PDO('mysql:host=localhost;dbname=pmu;charset=utf8', 'admin', 'admin');
        }
        /* Arrête l'exécution du script est affiche un message d'erreur */
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }

    /* Gestion de la connexion avec la BDD 
    Pamamètres d'entrée : requete et les variables utiles pour exécuter la requête (pour la condition WHERE par exemple)
    Retourne : le résultat de la requete si c'est un select
    */
    public static function requete($requete, $params = array()){
        try{
            $connexion = self::connexion()->prepare($requete);
            $connexion->execute($params);
            if(explode(' ', $requete)[0] == 'SELECT'){
                return $connexion->fetchAll();
            }
        }
        /* Arrête l'exécution du script est affiche un message d'erreur */
        catch(Exception $e){
            die($e);
        }
    }
}

?>