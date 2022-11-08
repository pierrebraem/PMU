<?php
$url = '';
if(isset($_GET['url'])){
    $url = explode('/', $_GET['url']);
}

switch($url[0]){
    case '':
        require 'pages/accueil.php';
        break;
    case 'parcourir':
        require 'pages/parcourir.php';
        break;
    case 'conseil':
        require 'pages/conseil.php';
        break;
    case 'panier':
        require 'pages/panier.php';
        break;
    case 'connexion':
        require 'pages/connexion.php';
        break;
    default:
        require 'pages/404.php';
        break;
}
?>