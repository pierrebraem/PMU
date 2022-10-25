<?php
    require '../classes/connexion.php';

    $db = connexion();

    $categoriesRequete = $db->prepare("SELECT * FROM categorie");
    $categoriesRequete->execute();
    $categories = $categoriesRequete->fetchAll();

    foreach($categories as $categorie){
        echo($categorie['id']);
        echo($categorie['nom']);
        echo('<br>');
    }
?>