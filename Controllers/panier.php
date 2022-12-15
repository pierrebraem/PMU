<?php
require_once './controllers/controller.php';
require_once './models/panier.php';

class PanierController extends Controller{
    /* Procédure pour ajouter un article dans le panier
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function ajouter(){
        /* Vérifie si l'utilisateur est connecté */
        if(empty($_SESSION)){
            header('Location: ../connexion');
        }
        else{
            /* Récupère l'id de l'article et sa quantité */
            $id = $_POST['id'];
            $quantite = $_POST['quantite'];

            $panier = new Panier();

            /* Vérifie si le panier à l'utilisateur existe, sinon en créer un nouveau */
            if(empty($panier->checkExistancePanier($_SESSION['id']))){
                $panier->creerNouveauPanier($_SESSION['id']);
            }

            /* Obtenir l'id du panier */
            $idPanier = $panier->getPanier($_SESSION['id'])[0]['id'];
            
            /* Vérifie si l'article qu'on souhaite ajouter n'existe pas déjà */
            if(empty($panier->checkExistanceArticle($idPanier, $id))){
                /* Si il n'existe pas, ajouter dans le panier */
                $panier->ajouterArticle($idPanier, $id, $quantite);
            }
            else{
                /* Sinon ajouter la quantité souhaiter en plus */
                $panier->modifierQuantite($idPanier, $id, $quantite, 'plus');
            }

            header('Location: ../parcourir');
        }
    }

    /* Procédure pour supprimer un article
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function supprimer(){
        /* Vérifie que l'utilisateur est connecté */
        if(empty($_SESSION)){
            header('Location: ../connexion');
        }
        else{
            /* Récupère l'id du panier et l'id du produit qu'on souhaite supprimer */
            $idPanier = $_POST['idPanier'];
            $idProduit = $_POST['idProduit'];

            $panier = new panier();

            /* Supprime l'article du panier */
            $panier->supprimerArticle($idPanier, $idProduit);

            header('Location: ../panier');
        }
    }
}
?>