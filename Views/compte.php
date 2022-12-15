<!-- 
Affiche les informations du compte
Affiche le formulaire de modification du compte
Affiche le formulaire pour changer le mot de passe
Affiche l'historique des commandes du compte
-->
<?php 
    require_once 'src/header.php';
    require_once './models/compte.php';
    $compte = new Compte();

    /* Récupère les informations du compte ainsi que son historique des commandes */
    $unCompte = $compte->getCompte($_SESSION['id']);
    $commandes = $compte->getCommandes($_SESSION['id']);
?>

<!-- Div pour afficher les erreurs -->
<div id="etatModifierInfos"></div>
<?php if(isset($_GET['action']) && $_GET['action'] == 'changerInfos'): ?>
    <!-- Modification d'information -->
    <div class="col d-flex justify-content-center">
        <div class="card w-75 text-center">
            <h5 class="card-header">Changer d'informations</h5>
            <div class="card-body">
                <form action="compte/modifier" method="post">
                    <!-- Demande le nouveau nom -->
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?php echo($unCompte[0]['nom']); ?>">
                    </div>
                    <!-- Demande le nouveau prénom -->
                    <div class="col pt-3">
                        <input type="text" class="form-control" placeholder="Prenom" name="prenom" value="<?php echo($unCompte[0]['prenom']); ?>">
                    </div>
                    <!-- Demande le nouveau mail -->
                    <div class="col pt-3">
                        <input type="text" class="form-control" placeholder="Mail" name="email" value="<?php echo($unCompte[0]['mail']); ?>">
                    </div>
                    <!-- Demande le nouveau pays -->
                    <div class="col pt-3">
                        <select name="pays" class="form-control">
                            <option value="none" selected>Choissiez un pays</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Canada">Canada</option>
                            <option value="France">France</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <!-- Demande la nouvelle adresse -->
                    <div class="col pt-3">
                        <input type="text" class="form-control" placeholder="Adresse" name="adresse" value="<?php echo($unCompte[0]['adresse']); ?>">
                    </div>
                    <!-- Demande la nouvelle ville -->
                    <div class="col pt-3">
                        <input type="text" class="form-control" placeholder="Ville" name="ville" value="<?php echo($unCompte[0]['ville']); ?>">
                    </div>
                    <!-- Demande le nouveau code postal -->
                    <div class="col pt-3">
                        <input type="text" class="form-control" placeholder="Code postal" name="cp" value="<?php echo($unCompte[0]['codepostal']); ?>">
                    </div>
                    <!-- Demande le nouveau numéro de téléphone -->
                    <div class="col pt-3">
                        <input type="text" class="form-control" placeholder="Téléphone" name="telephone" value="<?php echo($unCompte[0]['telephone']); ?>">
                    </div>
                    <div class="col pt-3 text-center">
                        <button type="submit" class="btn btn-success">Changer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php else: ?>

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
            <a class="btn btn-primary" href="./compte?action=changerInfos">Changer les informations</a>
        </div>
    </div>
</div>

<!-- Changement mot de passe -->
<div class="col d-flex justify-content-center mt-5">
    <div class="card w-75 text-center">
        <h5 class="card-header">Changer de mot de passe</h5>
        <div class="card-body">
            <form action="compte/modifierMDP" method="post">
                <!-- Demande l'ancien mot de passe -->
                <div class="col pb-3">
                    <input class="form-control" type="password" name="AMDP" placeholder="Ancien mot de passe">
                </div>
                <!-- Demande le nouveau mot de passe -->
                <div class="col pb-3">
                    <input class="form-control" type="password" name="MDP" placeholder="Nouveau mot de passe">
                </div>
                <!-- Confirmer mot de passe -->
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
            <?php if(empty($commandes)): ?>
                <li class="list-group-item">
                    <p>Aucune commande enregistrée</p>
                </li>
            <?php else: ?>
                <?php foreach($commandes as $uneCommande): ?>
                    <li class="list-group-item">
                        <p>Commande du <?php echo($uneCommande['date']); ?></p>
                        <a class="btn btn-primary" href="./compte?DetailCommande=<?php echo($uneCommande['id']); ?>">Détail</a>
                        <form action="commande/telecharger" method="post">
                            <input type="hidden" name="id" value="<?php echo($uneCommande['id']); ?>">
                            <input type="submit" class="btn btn-danger" value="Télécharger PDF">
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<script type="text/javascript">
    /* Récupère la div pour afficher l'erreur */
    const divModifierInfos = document.getElementById('etatModifierInfos');
    /* Récupère le code d'erreur et dans quel catégorie ça vient */
    let param = window.location.href.split('?')[1];
    let param2 = window.location.href.split('&')[1];
    /* Si il y a erreur, afficher un message d'erreur */
    if(param2 != undefined || param != undefined){
        if(param.split('=')[1] != 'modifie' && param.split('=')[1] != 'MDPmodifie'){
            let value = param2.split('=')[1];
            switch(value){
                case 'Enull':
                    divModifierInfos.innerHTML = '<div class="alert alert-danger" role="alert">Un des champs suivants est vide : nom, prénom, adresse mail</div>';
                    break;
                case 'Emdp':
                    divModifierInfos.innerHTML = '<div class="alert alert-danger" role="alert">le champ mot de passe et confirmer mot de passe ne sont pas les mêmes</div>';
                    break;
                case 'Epays':
                    divModifierInfos.innerHTML = '<div class="alert alert-danger" role="alert">Aucun pays n\'a était sélectionné</div>';
                    break;
                case 'Email':
                    divModifierInfos.innerHTML = '<div class="alert alert-danger" role="alert">L\'adresse email saisi existe déjà</div>';
                    break;
                case 'MA':
                    divModifierInfos.innerHTML = '<div class="alert alert-danger" role="alert">Mot de passe actuel incorrect</div>';
                    break;
                case 'MDPC':
                    divModifierInfos.innerHTML = '<div class="alert alert-danger" role="alert">le champ mot de passe et confirmer mot de passe ne sont pas les mêmes</div>';
                    break;
            }
        }
        else if(param.split('=')[1] == 'modifie'){
            divModifierInfos.innerHTML = '<div class="alert alert-success" role="alert">Informations du compte modifiées</div>';
        }
        else{
            divModifierInfos.innerHTML = '<div class="alert alert-success" role="alert">Mot de passe modifié</div>';
        }
    }
</script>
<?php require_once 'src/footer.php' ?>