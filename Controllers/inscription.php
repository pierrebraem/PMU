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

        $inscription = new InscriptionM($nom, $prenom, $email, $mdp, $pays, $adresse, $ville, $cp, $telephone);
     
        $inscription->insertion();
    }
}
?>