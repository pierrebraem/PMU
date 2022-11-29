<?php
require_once './controllers/controller.php';
require_once './models/inscription.php';

class Inscription extends Controller{
    public static function inscription(){
        /* Récupère les données du POST et les mets dans des variables. */
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
        if($mdp != $mdpc){
            echo '<p>Erreur: le champ mot de passe et confirmer mot de passe ne sont pas les mêmes</p>';
            $erreur = true;
        }

        if($nom == "" || $prenom == "" || $email == "" || $mdp == ""){
            echo '<p>Un des champs suivants est vide : nom, prénom, adresse mail, mot de passe</p>';
            $erreur = true;
        }

        if($pays == "none"){
            echo '<p>Aucun pays n\'a était sélectionné</p>';
            $erreur = true;
        }

        foreach($inscription->checkmail() as $mail){
            if($email == $mail[0]){
                echo '<p>Un compte avec cette adresse mail : '.$email.' existe déjà.</p>';
                $erreur = true;
                break;
            }
        }


        /* Si pas d'erreur, ajouter l'utilisateur */
        if($erreur == false){
            $inscription->insertion();
            echo '<p>Votre compte a était créé avec succès</p>';

        }
        echo '<a href="../inscription">Retour</a>';
    }
}
?>