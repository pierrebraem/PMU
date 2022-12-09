<?php
require_once './controllers/controller.php';
require_once './models/conseil.php';

class ConseilController extends Controller{
    public static function recherche(){
        $nom = $_POST['nom'];
        header('Location: ../conseil?search='.$nom);
    }

    public static function detail(){
        $id = $_POST['id'];
        header('Location: ../conseil?id='.$id);
    }
}
?>