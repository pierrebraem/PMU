<?php
require_once './controllers/controller.php';
require_once './models/conseil.php';

class ConseilController extends Controller{
    /* Demande à la vue d'afficher uniquement les conseils demander par l'utilisateur
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function recherche(){
        $nom = $_POST['nom'];
        header('Location: ../conseil?search='.$nom);
    }

    /* Demande à la vue d'afficher uniquement les détails du conseil souhaité
    Pamamètre d'entrée : aucun
    Retourne : pas de retour
    */
    public static function detail(){
        $id = $_POST['id'];
        header('Location: ../conseil?id='.$id);
    }
}
?>