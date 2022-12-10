<?php
    require_once './classes/connexionBDD.php';

    class Compte extends BDD{
        /* Récupère les informations d'un compte */
        public function getCompte($id){
            return self::requete('SELECT nom, prenom, pays, adresse, ville, codepostal, telephone, mail FROM compte WHERE id = :id', array('id' => $id));
        }
    }
?>