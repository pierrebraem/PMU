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
        AccueilController::index('accueil');
    });

    /* Routes pour la page conseil */
    Route::set('conseil', function(){
        ConseilController::index('conseil');
    });

    Route::set('conseil/search', function(){
        ConseilController::recherche();
    });

    Route::set('conseil/detail', function(){
        ConseilController::detail();
    });

    /* Routes pour la page panier */
    Route::set('panier', function(){
        PanierController::index('panier');
    });

    /* Routes pour la page parcourir */
    Route::set('parcourir', function(){
        ParcourirController::index('parcourir');
    });

    Route::set('parcourir/search', function(){
        ParcourirController::recherche();
    });

    Route::set('parcourir/detail', function(){
        ParcourirController::detail();
    });

    /* Routes réservées à ceux qui sont connectés */
    if(!empty($_SESSION)){
        /* Routes pour la page compte */
        Route::set('compte', function(){
            CompteController::index('compte');
        });

        /* Route pour la déconnexion */
        Route::set('connexion/deconnection', function(){
            ConnexionController::deconnexion();
        });
    }
    /* Routes réservées à ceux qui ne sont pas connectés */
    else{
        /* Routes pour la page connexion */
        Route::set('connexion', function(){
            ConnexionController::index('connexion');
        });

        Route::set('connexion/connexion', function(){
            ConnexionController::connexion();
        });

        /* Routes pour la page inscription */
        Route::set('inscription', function(){
            InscriptionController::index('inscription');
        });

        Route::set('inscription/inscrit', function(){
            InscriptionController::inscription();
        });
    }
?>