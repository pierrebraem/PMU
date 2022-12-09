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
            die();
            $erreur = true;
        }

        if($nom == "" || $prenom == "" || $email == "" || $mdp == ""){
            header('Location: ../inscription?etat=Enull');
            die();
            $erreur = true;
        }

        if($pays == "none"){
            header('Location: ../inscription?etat=Epays');
            die();
            $erreur = true;
        }

        foreach($inscription->checkmail() as $mail){
            if($email == $mail[0]){
                header('Location: ../inscription?etat=Eemail');
                die();
                $erreur = true;
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