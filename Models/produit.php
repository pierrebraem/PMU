<?php
    require_once './classes/connexionBDD.php';

    class Produit extends BDD{
        /* Récupère tous les produits */
        public function allProduits(){
            return self::requete('SELECT * FROM produit');
        }

        /* Récupère tous les produits de la recherche */
        public function recherche($nom){
            return self::requete('SELECT * FROM produit WHERE nom LIKE :nom"%"', array('nom' => $nom));
        }
    }
?>