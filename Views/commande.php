<!-- Demande les informations personnels et bancaires pour la commande -->
<?php 
require_once 'src/header.php'; ?>

<!-- Si une commande est effectuée, afficher le message de confirmation et propose de télécharger la facture en PDF -->
<?php if(isset($_GET['acheter'])): ?>
    <div class="alert alert-success" role="alert">Votre commande a était effectuée</div>
    <div class="text-center">
        <form action="commande/telecharger" method="post">
            <input type="hidden" name="id" value="<?php echo($_GET['commande_id']); ?>">
            <input type="submit" class="btn btn-danger" value="Télécharger le PDF">
        </form>
    </div>
<!-- Sinon affiche la page normalement -->
<?php else: ?>
    <!-- Div servant à afficher une erreur -->
    <div id="etatCommande"></div>
    <div class="row d-flex justify-content-center">
        <form action="commande/commander" method="post">
            <!-- Demande d'informations de livraison -->
            <div class="col pb-3">
                <div class="card">
                    <h5 class="card-header">Informations livraison</h5>
                    <div class="card-body">
                    <!-- Demande le nom et le prénom de l'acheteur -->
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="nom" placeholder="Nom">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="prenom" placeholder="Prenom">
                        </div>
                    </div>
                    <!-- Demande l'adresse mail et le numéro de téléphone de l'acheteur -->
                    <div class="row pt-3">
                        <div class="col">
                            <input type="email" class="form-control" name="email" placeholder="Adresse mail">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="telephone" placeholder="Téléphone">
                        </div>
                    </div>
                    <!-- Demande le pays de résistance de l'acheteur -->
                    <div class="row pt-3">
                        <div class="col">
                            <select name="pays" class="form-control">
                                <option value="none" selected>Choissiez un pays</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Canada">Canada</option>
                                <option value="France">France</option>
                                <option value="Suisse">Suisse</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    <!-- Demande l'adresse postale de l'acheteur -->
                    <div class="row pt-3">
                        <div class="col">
                            <input type="text" class="form-control" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="ville" placeholder="Ville">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="cp" placeholder="Code Postal">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Demande les informations bancaires -->
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Informations bancaires</h5>
                    <div class="card-body">
                        <!-- Demande le nom du titulaire de la carte -->
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="titulaire" placeholder="Nom du titulaire de la carte">
                            </div>
                        </div>
                        <!-- Demande les numéros de cartes -->
                        <div class="row pt-3">
                            <div class="col">
                                <input type="text" class="form-control" name="numerocb" placeholder="Numéro de la carte">
                            </div>
                        </div>
                        <!-- Demande la date d'expiration et le cryptogramme -->
                        <div class="row pt-3">
                            <div class="col">
                                <input type="text" class="form-control" name="expiration" placeholder="date d'expiration">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="codeSecret" placeholder="3 chiffre derrière la carte">
                            </div>
                        </div>
                        <!-- Bouton pour valider les informations -->
                        <div class="row pt-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Payer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        /* Récupère la div pour afficher l'erreur */
        const divCommande = document.getElementById('etatCommande');
        /* Récupère le code d'erreur */
        let param = window.location.href.split('?')[1];
        /* Si il y a erreur, afficher un message d'erreur */
        if(param != undefined){
            let value = param.split('=')[1];
            switch(value){
                case 'Enull':
                    divCommande.innerHTML = '<div class="alert alert-danger" role="alert">Un des champs suivants est vide : nom, prénom, adresse mail, téléphone, adresse, ville ou code postale</div>';
                    break;
                case 'Epays':
                    divCommande.innerHTML = '<div class="alert alert-danger" role="alert">Aucun pays n\'a était sélectionné</div>';
                    break;
            }
        }
    </script>
<?php endif; ?>

<?php require_once 'src/footer.php'; ?>