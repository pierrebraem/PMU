<?php
    require_once './classes/connexionBDD.php';

    class Produit extends BDD{
        /* Récupère tous les produits */
        public function allProduits(){
            return self::requete('SELECT * FROM produit');
        }
    }
?>