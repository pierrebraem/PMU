<?php
require_once './controllers/controller.php';
require_once './models/conseil.php';

class ConseilController extends Controller{
    public static function recherche(){
        $nom = $_POST['nom'];
        $conseil = new Conseil();
        header('Location: ../conseil?search='.$nom);
    }
}
?>