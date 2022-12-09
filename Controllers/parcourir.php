<?php
require_once './controllers/controller.php';
require_once './models/produit.php';

class Parcourir extends Controller{
    public static function recherche(){
        $nom = $_POST['nom'];
        $produit = new Produit();
        header('Location: ../parcourir?search='.$nom);
    }
}
?>