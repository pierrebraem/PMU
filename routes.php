<?php
    require_once('./classes/route.php');
    require_once('./controllers/accueil.php');
    require_once('./controllers/compte.php');
    require_once('./controllers/connexion.php');
    require_once('./controllers/conseil.php');
    require_once('./controllers/inscription.php');
    require_once('./controllers/panier.php');
    require_once('./controllers/parcourir.php');

    Route::set('index.php', function(){
        Accueil::index('accueil');
    });

    Route::set('compte', function(){
        Accueil::index('compte');
    });

    Route::set('connexion', function(){
        Connexion::index('connexion');
    });

    Route::set('conseil', function(){
        Connexion::index('conseil');
    });

    Route::set('inscription', function(){
        Inscription::index('inscription');
    });

    Route::set('panier', function(){
        Connexion::index('panier');
    });

    Route::set('parcourir', function(){
        Connexion::index('parcourir');
    });
?>