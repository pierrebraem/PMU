<?php
require_once './controllers/controller.php';
require_once './models/compte.php';

class CompteController extends Controller{
    public static function modifier(){
        $id = $_SESSION['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $ville = $_POST['ville'];
        $cp = $_POST['cp'];
        $pays = $_POST['pays'];
        $erreur = false;

        $compte = new Compte();

        /* Gestion d'erreurs */
        if($nom == "" || $prenom == "" || $email == ""){
            header('Location: ../compte?action=changerInfos&etat=Enull');
            $erreur = true;
            die();
        }

        if($pays == "none"){
            header('Location: ../compte?action=changerInfos&etat=Epays');
            $erreur = true;
            die();
        }

        foreach($compte->checkmail($_SESSION['id']) as $mail){
            if($email == $mail[0]){
                header('Location: ../compte?action=changerInfos&etat=Email');
                $erreur = true;
                die();
                break;
            }
        }

        /* Si pas d'erreur, modifier les information */
        if($erreur == false){
            $compte->modifierInfos($_SESSION['id'], $nom, $prenom, $email, $adresse, $telephone, $ville, $cp, $pays);
            header('Location: ../compte?action=modifie');
            die();
        }
    }

    public static function modifierMDP(){
        $AMDP = $_POST['AMDP'];
        $MDP = $_POST['MDP'];
        $MDPC = $_POST['MDPC'];

        $compte = new Compte();

        if(!password_verify($AMDP, $compte->checkMDP($_SESSION['id'])[0]['mdp'])){
            header('Location: ../compte?action=changerMDP&etat=MA');
            die();
        }
        elseif($MDP != $MDPC){
            header('Location: ../compte?action=changerMDP&etat=MDPC');
            die();
        }
        else{
            $compte->changerMDP($_SESSION['id'], password_hash($MDP, PASSWORD_ARGON2I));
            header('Location: ../compte?action=MDPmodifie');
            die();
        }
    }
}
?>