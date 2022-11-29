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
        }


    }
}
?>