<?php
    require_once './classes/connexionBDD.php';

    class Categorie extends BDD{
        /* Récupère les 3 catégories où il y a le plus de produits
        Paramètre d'entrée : aucun
        Retourne : les catégories et leurs nombres totaux
        */
        public function allCategories(){
            return self::requete('SELECT COUNT(p.id_categorie) AS nombre, c.nom FROM produit p INNER JOIN categorie c ON p.id_categorie = c.id GROUP BY c.nom ORDER BY nombre DESC LIMIT 3');
        }
    }
?>