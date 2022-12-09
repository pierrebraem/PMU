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

        /* Récupère toutes les informations d'un conseil */
        public function getConseil($id){
            return self::requete('SELECT * FROM conseil WHERE id = :id', array('id' => $id));
        }

        /* Récupère tous les noms des pièces d'un conseil */
        public function allProduits($id){
            return self::requete('SELECT p.id, p.nom FROM conseil_produit cp INNER JOIN produit p ON cp.id_produit = p.id WHERE cp.id_conseil = :id', array('id' => $id));
        }
    }
?>