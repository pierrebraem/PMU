<?php
    function connexion(){
        try{
            return new PDO('mysql:host=localhost;dbname=pmu;charset=utf8', 'admin', 'admin');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
?>