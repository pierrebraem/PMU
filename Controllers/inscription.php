<?php
require_once './controllers/controller.php';
require_once './models/inscription.php';

class InscriptionController extends Controller{
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
            header('Location: ../inscription?etat=Emdp');
            $erreur = true;
            die();
        }

        if($nom == "" || $prenom == "" || $email == "" || $mdp == ""){
            header('Location: ../inscription?etat=Enull');
            $erreur = true;
            die();
        }

        if($pays == "none"){
            header('Location: ../inscription?etat=Epays');
            $erreur = true;
            die();
        }

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