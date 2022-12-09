<?php
require_once './controllers/controller.php';
require_once './models/produit.php';

class ParcourirController extends Controller{
    public static function recherche(){
        $nom = $_POST['nom'];
        header('Location: ../parcourir?search='.$nom);
    }

    public static function detail(){
        $id = $_POST['id'];
        header('Location: ../parcourir?id='.$id);
    }
}
?>