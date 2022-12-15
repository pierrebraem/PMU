<?php
require_once './controllers/controller.php';
require_once './models/compte.php';

class CompteController extends Controller{
    /* Vérifie si les nouvelles informations saisi par l'utilisateur sont juste
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function modifier(){
        /* Récupère les informations du POST */
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
        /* Vérifie que toutes les informations obligatoires ont était saisis */
        if($nom == "" || $prenom == "" || $email == ""){
            header('Location: ../compte?action=changerInfos&etat=Enull');
            $erreur = true;
            die();
        }

        /* Vérifie que le pays a était choisi */
        if($pays == "none"){
            header('Location: ../compte?action=changerInfos&etat=Epays');
            $erreur = true;
            die();
        }

        /* Vérifie que l'adresse mail n'existe pas déjà */
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

    /* Vérifie si les informations de mot de passe
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function modifierMDP(){
        /* Récupère les informations du POST */
        $AMDP = $_POST['AMDP'];
        $MDP = $_POST['MDP'];
        $MDPC = $_POST['MDPC'];

        $compte = new Compte();

        /* Vérifie que l'ancien mot de passe correspond à celle saisi par l'utilisateur */
        if(!password_verify($AMDP, $compte->checkMDP($_SESSION['id'])[0]['mdp'])){
            header('Location: ../compte?action=changerMDP&etat=MA');
            die();
        }
        /* Vérifie si le champ "mot de passe" et "confirmer mot de passe" sont les mêmes */
        elseif($MDP != $MDPC){
            header('Location: ../compte?action=changerMDP&etat=MDPC');
            die();
        }
        /* Applique le changement de mot de passe */
        else{
            $compte->changerMDP($_SESSION['id'], password_hash($MDP, PASSWORD_ARGON2I));
            header('Location: ../compte?action=MDPmodifie');
            die();
        }
    }
}
?>