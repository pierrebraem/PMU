<?php
require_once './controllers/controller.php';
require_once './models/connexion.php';

class Connexion extends Controller{
    public static function connexion(){
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $erreur = false;

        $connexion = new ConnexionM($email, $mdp);

        $informationConnexion = $connexion->checkconnexion($email);

        if(empty($informationConnexion) || !password_verify($mdp, $informationConnexion[0]['mdp'])){
            echo '<p>Adresse mail ou mot de passe incorrectes</p>';
        }
        else{
            echo '<p>Connexion réussi</p>';
            session_start();
            $_SESSION['id'] = $informationConnexion[0]['id'];
            $_SESSION['mail'] = $informationConnexion[0]['mail'];
            //unset($_SESSION['id'], $_SESSION['mail']);
        }
        echo '<a href="../connexion">Retour</a>';
    }

    public static function deconnexion(){
        session_start();
        unset($_SESSION['id'], $_SESSION['mail']);
        echo '<p>Déconnexion réussi</p>';
        echo '<a href="..">Retour</a>';
    }
}
?>