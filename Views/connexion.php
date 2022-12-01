<?php require 'src/header.php' ?>

<div id="etatConnexion"></div>
<div class="col d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <form action="connexion/connexion" method="post">
                <div class="form-group">
                    <label for="adresseMailConnexion">Adresse mail :</label>
                    <input type="email" name="email" class="form-control" id="adresseMailConnexion" placeholder="Adresse mail">
                </div>
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
    const divInscription = document.getElementById('etatConnexion');
    let param = window.location.href.split('?')[1];
    if(param != undefined){
        divInscription.innerHTML = '<div class="alert alert-danger" role="danger">L\'adresse mail et/ou le mot de passe est(sont) incorrect(s)</div>';
    }
</script>

<?php require 'src/footer.php' ?>