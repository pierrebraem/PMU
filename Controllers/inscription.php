<?php
require_once './controllers/controller.php';
require_once './models/inscription.php';

class InscriptionController extends Controller{
    /* Vérifie les informations saisi par l'utilisateur
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function inscription(){
        /* Récupère les données du POST */
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $mdpc = $_POST['mdpc'];
        $pays = $_POST['pays'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $ville = $_POST['ville'];
        $cp = $_POST['cp'];
        $erreur = false;

        $inscription = new InscriptionM($nom, $prenom, $email, $mdp, $pays, $adresse, $ville, $cp, $telephone);

        /* Gestion d'erreurs */
        /* Vérifie si le champ "mot de passe" et "confirmer mot de passe" sont les mêmes */
        if($mdp != $mdpc){
            header('Location: ../inscription?etat=Emdp');
            $erreur = true;
            die();
        }

        /* Vérifie que toutes les informations obligatoires ont était saisis */
        if($nom == "" || $prenom == "" || $email == "" || $mdp == ""){
            header('Location: ../inscription?etat=Enull');
            $erreur = true;
            die();
        }

        /* Vérifie que le pays a était choisi */
        if($pays == "none"){
            header('Location: ../inscription?etat=Epays');
            $erreur = true;
            die();
        }

        /* Vérifie que l'adresse mail n'existe pas déjà */
        foreach($inscription->checkmail() as $mail){
            if($email == $mail[0]){
                header('Location: ../inscription?etat=Eemail');
                $erreur = true;
                die();
                break;
            }
        }


        /* Si pas d'erreur, ajouter l'utilisateur */
        if($erreur == false){
            $inscription->insertion();
            header('Location: ../inscription?etat=R');
            die();
        }
    }
}
?>