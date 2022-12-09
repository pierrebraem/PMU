<?php require 'src/header.php' ?>

<!-- Informations compte -->
<div class="col d-flex justify-content-center">
    <div class="card w-75 text-center">
        <h5 class="card-header">Profil</h5>
        <div class="card-body">
            <p>Nom : Braem</p>
            <p>Prénom : Pierre</p>
            <p>mail : pierrebraem@orange.fr</p>
            <p>Pays : France</p>
            <p>Adresse : 9, Campus du Mont Houy</p>
            <p>Ville : Valenciennes</p>
            <p>Code postal : 59313</p>
            <p>Téléphone : 0303030303</p>
            <a class="btn btn-primary" href="#">Changer les informations</a>
        </div>
    </div>
</div>

<!-- Changement mot de passe -->
<div class="col d-flex justify-content-center mt-5">
    <div class="card w-75 text-center">
        <h5 class="card-header">Changer de mot de passe</h5>
        <div class="card-body">
            <form class="form-inline">
                <div class="col pb-3">
                    <input class="form-control" type="password" name="AMDP" placeholder="Ancien mot de passe">
                </div>
                <div class="col pb-3">
                    <input class="form-control" type="password" name="MDP" placeholder="Nouveau mot de passe">
                </div>
                <div class="col pb-3">
                    <input class="form-control" type="password" name="MDPC" placeholder="Confirmer mot de passe">
                </div>
                <button class="btn btn-primary" type="submit">Changer de mot de passe</button>
            </form>
        </div>
    </div>
</div>

<!-- Historique commandes -->
<div class="col d-flex justify-content-center mt-5">
    <div class="card w-75 text-center">
        <h5 class="card-header">Historique des commandes</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <p>Commande du 01-01-2022</p>
                <a class="btn btn-primary" href="#">Détail</a>
                <a class="btn btn-danger" href="#">Télécharger PDF</a>
            </li>
            <li class="list-group-item">
                <p>Commande du 02-01-2022</p>
                <a class="btn btn-primary" href="#">Détail</a>
                <a class="btn btn-danger" href="#">Télécharger PDF</a>
            </li>
            <li class="list-group-item">
                <p>Commande du 03-01-2022</p>
                <a class="btn btn-primary" href="#">Détail</a>
                <a class="btn btn-danger" href="#">Télécharger PDF</a>
            </li>
        </ul>
    </div>
</div>

<?php require 'src/footer.php' ?>