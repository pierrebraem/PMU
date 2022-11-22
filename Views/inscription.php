<?php require 'src/header.php' ?>

<div class="col d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" id="nomInscription" placeholder="Nom">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="prenomInscription" placeholder="Prenom">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <input type="email" class="form-control" id="emailInscription" placeholder="Adresse mail">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <input type="password" class="form-control" id="mdpInscription" placeholder="Mot de passe">
                    </div>
                    <div class="col">
                        <input type="password" class="form-control" id="cmdpInscription" placeholder="Mot de passe">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <select id="paysInscription" class="form-control">
                            <option value="none" selected>Choissiez un pays</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Canada">Canada</option>
                            <option value="France">France</option>
                            <option value="Suisse">Suisse</option>
                        </select>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <input type="text" class="form-control" id="adresseInscription" placeholder="Adresse">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="villeInscription" placeholder="Ville">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="cpInscription" placeholder="Code Postal">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Inscription</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'src/footer.php' ?>