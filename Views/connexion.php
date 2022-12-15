<!-- Formulaire de connexion -->
<?php require_once 'src/header.php' ?>

<!-- Div servant à afficher une erreur -->
<div id="etatConnexion"></div>
<div class="col d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <form action="connexion/connexion" method="post">
                <!-- Demande l'adresse mail -->
                <div class="form-group">
                    <label for="adresseMailConnexion">Adresse mail :</label>
                    <input type="email" name="email" class="form-control" id="adresseMailConnexion" placeholder="Adresse mail">
                </div>
                <!-- Demande le mot de passe -->
                <div class="form-group">
                    <label for="mdpConnexion">Mot de passe :</label>
                    <input type="password" name="mdp" class="form-control" id="mdpConnexion" placeholder="Mot de passe">
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-success">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    /* Récupère la div pour afficher l'erreur */
    const divInscription = document.getElementById('etatConnexion');
    /* Récupère le code d'erreur */
    let param = window.location.href.split('?')[1];
    /* Si il y a erreur, afficher un message d'erreur */
    if(param != undefined){
        divInscription.innerHTML = '<div class="alert alert-danger" role="danger">L\'adresse mail et/ou le mot de passe est(sont) incorrect(s)</div>';
    }
</script>

<?php require 'src/footer.php' ?>