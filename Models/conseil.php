<?php
    require_once './classes/connexionBDD.php';

    class Conseil extends BDD{
        /* Récupère tous les informations de tous les conseils 
        Paramètre d'entrée : aucun
        Retourne : les informations de tous les conseils
        */
        public function allConseils(){
            return self::requete('SELECT * FROM conseil');
        }

        /* Récupère les conseils conserner par la recherche
        Paramètre d'entrée : nom de la recherche
        Retourne : résultat de la recherche
        */
        public function recherche($nom){
            return self::requete('SELECT * FROM conseil WHERE nom LIKE :nom"%"', array('nom' => $nom));
        }

        /* Récupère toutes les informations d'un conseil 
        Paramètre d'entrée : l'id du conseil
        Retourne : les informations du conseil
        */
        public function getConseil($id){
            return self::requete('SELECT * FROM conseil WHERE id = :id', array('id' => $id));
        }

        /* Récupère tous les noms des pièces d'un conseil ainsi que son id
        Paramètre d'entrée : l'id du conseil
        Retourne : l'id et le nom des pièces
        */
        public function allProduits($id){
            return self::requete('SELECT p.id, p.nom FROM conseil_produit cp INNER JOIN produit p ON cp.id_produit = p.id WHERE cp.id_conseil = :id', array('id' => $id));
        }
    }
?>