<?php require 'src/header.php' ?>

<div class="col d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="adresseMailConnexion">Adresse mail :</label>
                    <input type="email" class="form-control" id="adresseMailConnexion" placeholder="Adresse mail">
                </div>
                <div class="form-group">
                    <label for="mdpConnexion">Mot de passe :</label>
                    <input type="password" class="form-control" id="mdpConnexion" placeholder="Mot de passe">
                </div>
                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-success">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'src/footer.php' ?>