<?php
require_once './controllers/controller.php';
require_once './models/connexion.php';

class ConnexionController extends Controller{
    /* Vérifie si les informations de connexion sont justes
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function connexion(){
        /* Récupère les données du POST */
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $erreur = false;

        $connexion = new ConnexionM($email, $mdp);

        $informationConnexion = $connexion->checkconnexion($email);

        /* Si l'adresse mail n'existe pas et/ou que le mot de passe est incorrect, afficher un message d'erreur */
        if(empty($informationConnexion) || !password_verify($mdp, $informationConnexion[0]['mdp'])){
            header('Location: ../connexion?etat=E');
            die();
        }
        /* Appliquer la connexion et instancier les variables de connexion */
        else{
            $_SESSION['id'] = $informationConnexion[0]['id'];
            $_SESSION['mail'] = $informationConnexion[0]['mail'];
            header('Location: ../');
            die();
        }
    }

    /* Déconnecte l'utilisateur
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function deconnexion(){
        unset($_SESSION['id'], $_SESSION['mail']);
        header('Location: ../');
        die();
    }
}
?>