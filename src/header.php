<!DOCTYPE html>
<html>
    <head>
        <title>PMU - Pièce Mécano à l'Unité</title>
        <meta charset="utf-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/pmu">PMU</a>
                <button class="navbar-toggler" type="button" data-bs-target="#navbarPMU" aria-controls="navbarPMU" aria-expanded="false" aria-label="Toggle navigation"></button>
                <div class="collapse navbar-collapse" id="navbarPMU">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="parcourir">Parcourir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="conseil">Conseil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="panier">Panier</a>
                        </li>
                        <?php if(empty($_SESSION)): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="inscription">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion">Connexion</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="compte">Mon compte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion/deconnection">Deconnection</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav></br>