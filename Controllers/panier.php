<?php
require_once './controllers/controller.php';
require_once './models/panier.php';

class PanierController extends Controller{
    public static function ajouter(){
        if(empty($_SESSION)){
            header('Location: ../connexion');
        }
        else{
            $id = $_POST['id'];
            $quantite = $_POST['quantite'];

            $panier = new Panier();

            if(empty($panier->checkExistancePanier($_SESSION['id']))){
                $panier->creerNouveauPanier($_SESSION['id']);
            }

            $idPanier = $panier->getPanier($_SESSION['id'])[0]['id'];
            
            if(empty($panier->checkExistanceArticle($idPanier, $id))){
                $panier->ajouterArticle($idPanier, $id, $quantite);
            }
            else{
                $panier->modifierQuantite($idPanier, $id, $quantite, 'plus');
            }

            header('Location: ../parcourir');
        }
    }
}
?>