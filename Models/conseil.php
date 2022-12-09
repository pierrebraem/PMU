<?php
    require_once './classes/connexionBDD.php';

    class Conseil extends BDD{
        /* Récupère tous les conseils */
        public function allConseils(){
            return self::requete('SELECT * FROM conseil');
        }

        /* Récupère tous les conseils de la recherche */
        public function recherche($nom){
            return self::requete('SELECT * FROM conseil WHERE nom LIKE :nom"%"', array('nom' => $nom));
        }
    }
?>