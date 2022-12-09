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

        /* Récupère tous les inforamtions d'un produit */
        public function getProduit($id){
            return self::requete('SELECT p.nom as nomp, p.description, p.image, p.prix, c.nom as nomc FROM produit p INNER JOIN categorie c ON p.id_categorie = c.id WHERE p.id = :id', array('id' => $id));
        }
    }
?>