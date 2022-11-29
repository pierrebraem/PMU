<?php
    require_once('./classes/route.php');
    require_once('./controllers/accueil.php');
    require_once('./controllers/compte.php');
    require_once('./controllers/connexion.php');
    require_once('./controllers/conseil.php');
    require_once('./controllers/inscription.php');
    require_once('./controllers/panier.php');
    require_once('./controllers/parcourir.php');

    /* Routes pour la page accueil */
    Route::set('', function(){
        Accueil::index('accueil');
    });

    /* Routes pour la page compte */
    Route::set('compte', function(){
        Compte::index('compte');
    });

    /* Routes pour la page connexion */
    Route::set('connexion', function(){
        Connexion::index('connexion');
    });

    /* Routes pour la page conseil */
    Route::set('conseil', function(){
        Connexion::index('conseil');
    });

    /* Routes pour la page inscription */
    Route::set('inscription', function(){
        Inscription::index('inscription');
    });

    Route::set('inscription/test', function(){
        Inscription::inscription();
    });

    /* Routes pour la page panier */
    Route::set('panier', function(){
        Connexion::index('panier');
    });

    /* Routes pour la page parcourir */
    Route::set('parcourir', function(){
        Connexion::index('parcourir');
    });
?>