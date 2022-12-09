<?php
    require_once './classes/connexionBDD.php';

    class Conseil extends BDD{
        /* Récupère tous les conseils */
        public function allConseils(){
            return self::requete('SELECT * FROM conseil');
        }
    }
?>