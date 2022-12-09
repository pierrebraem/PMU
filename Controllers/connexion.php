<?php
require_once './controllers/controller.php';
require_once './models/connexion.php';

class ConnexionController extends Controller{
    public static function connexion(){
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $erreur = false;

        $connexion = new ConnexionM($email, $mdp);

        $informationConnexion = $connexion->checkconnexion($email);

        if(empty($informationConnexion) || !password_verify($mdp, $informationConnexion[0]['mdp'])){
            header('Location: ../connexion?etat=E');
            die();
        }
        else{
            $_SESSION['id'] = $informationConnexion[0]['id'];
            $_SESSION['mail'] = $informationConnexion[0]['mail'];
            header('Location: ../');
            die();
        }
    }

    public static function deconnexion(){
        unset($_SESSION['id'], $_SESSION['mail']);
        header('Location: ../');
        die();
    }
}
?>