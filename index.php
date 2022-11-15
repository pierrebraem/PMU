<?php
$url = '';
if(isset($_GET['url'])){
    $url = explode('/', $_GET['url']);
}

switch($url[0]){
    case '':
        require 'Views/accueil.php';
        break;
    case 'parcourir':
        require 'Views/parcourir.php';
        break;
    case 'conseil':
        require 'Views/conseil.php';
        break;
    case 'panier':
        require 'Views/panier.php';
        break;
    case 'connexion':
        require 'Views/connexion.php';
        break;
    case 'inscription':
        require 'Views/inscription.php';
        break;
    case 'compte':
        require 'Views/compte.php';
        break;
    default:
        require 'Views/404.php';
        break;
}
?>