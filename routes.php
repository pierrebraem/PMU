<?php
    session_start();
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

    /* Routes pour la page conseil */
    Route::set('conseil', function(){
        Conseil::index('conseil');
    });

    /* Routes pour la page panier */
    Route::set('panier', function(){
        Panier::index('panier');
    });

    /* Routes pour la page parcourir */
    Route::set('parcourir', function(){
        Parcourir::index('parcourir');
    });

    /* Routes réservées à ceux qui sont connectés */
    if(!empty($_SESSION)){
        /* Routes pour la page compte */
        Route::set('compte', function(){
            Compte::index('compte');
        });

        /* Route pour la déconnexion */
        Route::set('connexion/deconnection', function(){
            Connexion::deconnexion();
        });
    }
    /* Routes réservées à ceux qui ne sont pas connectés */
    else{
        /* Routes pour la page connexion */
        Route::set('connexion', function(){
            Connexion::index('connexion');
        });

        Route::set('connexion/connexion', function(){
            Connexion::connexion();
        });

        /* Routes pour la page inscription */
        Route::set('inscription', function(){
            Inscription::index('inscription');
        });

        Route::set('inscription/inscrit', function(){
            Inscription::inscription();
        });
    }
?>