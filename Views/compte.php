<?php 
    require_once 'src/header.php';
    require_once './models/compte.php';
    $compte = new Compte();
    $unCompte = $compte->getCompte($_SESSION['id']);
?>

<!-- Informations compte -->
<div class="col d-flex justify-content-center">
    <div class="card w-75 text-center">
        <h5 class="card-header">Profil</h5>
        <div class="card-body">
            <p>Nom : <?php echo($unCompte[0]['nom']); ?></p>
            <p>Prénom : <?php echo($unCompte[0]['prenom']); ?></p>
            <p>mail : <?php echo($unCompte[0]['mail']); ?></p>
            <p>Pays : <?php echo($unCompte[0]['pays']); ?></p>
            <p>Adresse : <?php echo($unCompte[0]['adresse']); ?></p>
            <p>Ville : <?php echo($unCompte[0]['ville']); ?></p>
            <p>Code postal : <?php echo($unCompte[0]['codepostal']); ?></p>
            <p>Téléphone : <?php echo($unCompte[0]['telephone']); ?></p>
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