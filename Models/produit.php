<?php
    require_once './classes/connexionBDD.php';

    class Produit extends BDD{
        /* Récupère tous les produits 
        Paramètre d'entrée : aucun
        Retourne : liste de tous les produits dans la BDD
        */
        public function allProduits(){
            return self::requete('SELECT * FROM produit');
        }

        /* Récupère tous les produits de la recherche 
        Paramètre d'entrée : le contenu de la barre de recherche
        Retourne : le résultat de la recherche
        */
        public function recherche($nom){
            return self::requete('SELECT * FROM produit WHERE nom LIKE :nom"%"', array('nom' => $nom));
        }

        /* Récupère tous les informations d'un produit
        Paramètre d'entrée : l'id du produit
        Retourne : les informations du produit
        */
        public function getProduit($id){
            return self::requete('SELECT p.nom as nomp, p.description, p.image, p.prix, c.nom as nomc FROM produit p INNER JOIN categorie c ON p.id_categorie = c.id WHERE p.id = :id', array('id' => $id));
        }

        /* Récupère les produits en réduction 
        Paramètre d'entrée : aucun
        Retourne : les produits en réduction
        */
        public function getPromotions(){
            return self::requete('SELECT ROUND((prod.prix * (100-prom.rabais)) / 100, 2) AS \'prixReduit\', prom.id_produit, prom.date_fin FROM produit prod INNER JOIN promotion prom ON prod.id = prom.id_produit;');
        }
    }
?>