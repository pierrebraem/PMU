<?php require 'src/header.php' ?>

<div id="etatInscription"></div>
<div class="col d-flex justify-content-center">
    <div class="card w-50">
        <div class="card-body">
            <form action="inscription/inscrit" method="post">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" id="nomInscription" name="nom" placeholder="Nom">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="prenomInscription" name="prenom" placeholder="Prenom">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <input type="email" class="form-control" id="emailInscription" name="email" placeholder="Adresse mail">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="telephoneInscription" name="telephone" placeholder="Téléphone">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <input type="password" class="form-control" id="mdpInscription" name="mdp" placeholder="Mot de passe">
                    </div>
                    <div class="col">
                        <input type="password" class="form-control" id="cmdpInscription" name="mdpc" placeholder="Confirmer mot de passe">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <select id="paysInscription" name="pays" class="form-control">
                            <option value="none" selected>Choissiez un pays</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Canada">Canada</option>
                            <option value="France">France</option>
                            <option value="Suisse">Suisse</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <input type="text" class="form-control" id="adresseInscription" name="adresse" placeholder="Adresse">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="villeInscription" name="ville" placeholder="Ville">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="cpInscription" name="cp" placeholder="Code Postal">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" id="buttonInscription">Inscription</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    const divInscription = document.getElementById('etatInscription');
    let param = window.location.href.split('?')[1];
    if(param != undefined){
        let value = param.split('=')[1];
        switch(value){
            case 'Enull':
                divInscription.innerHTML = '<div class="alert alert-danger" role="alert">Un des champs suivants est vide : nom, prénom, adresse mail, mot de passe</div>';
                break;
            case 'Emdp':
                divInscription.innerHTML = '<div class="alert alert-danger" role="alert">le champ mot de passe et confirmer mot de passe ne sont pas les mêmes</div>';
                break;
            case 'Epays':
                divInscription.innerHTML = '<div class="alert alert-danger" role="alert">Aucun pays n\'a était sélectionné</div>';
                break;
            case 'Eemail':
                divInscription.innerHTML = '<div class="alert alert-danger" role="alert">L\'adresse email saisi existe déjà</div>';
                break;
            case 'R':
                divInscription.innerHTML = '<div class="alert alert-success" role="alert">Inscription réussi</div>';
                break;
        }
    }
</script>
<?php require 'src/footer.php' ?>