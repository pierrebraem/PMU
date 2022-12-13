<?php
require_once './controllers/controller.php';
require_once './models/commande.php';

class CommandeController extends Controller{
    public static function commander(){
        /* Récupère les données du POST */
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $pays = $_POST['pays'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $cp = $_POST['cp'];
        $erreur = false;

        $commande = new Commande($nom, $prenom, $email, $telephone, $pays, $adresse, $ville, $cp);

        /* Gestion d'erreurs */
        if($nom == "" || $prenom == "" || $email == "" || $telephone == "" || $adresse == "" || $ville == "" || $cp == ""){
            header('Location: ../commande?etat=Enull');
            $erreur = true;
            die();
        }

        if($pays == "none"){
            header('Location: ../commande?etat=Epays');
            $erreur = true;
            die();
        }

        if($erreur == false){
            $commande->setCommande($commande->getContenusPanier($_SESSION['id']), $_SESSION['id']);
            $commande->supprimerPanier($_SESSION['id']);
            header('Location: ../commande?acheter=true');
            die();
        }
    }
}
?>