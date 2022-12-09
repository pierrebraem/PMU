<?php require 'src/header.php' ?>

<div class="col d-flex justify-content-center">
    <div class="card w-75 text-center">
        <h5 class="card-header">Recherche</h5>
        <div class="card-body">
            <form class="form-inline">
                <input class="from-control" type="search" placeholder="Rechercher" aria-label="Recherche">
                <button class="btn btn-outline-success" type="submit">Ok</button>
            </form>
        </div>
    </div>
</div>

<div class="col d-flex justify-content-center mt-5">
    <div class="card w-75 text-center">
        <h5 class="card-header">Nom produit 1</h5>
        <div class="card-body">
            <p>Nom produit 1</p>
            <p>Description produit 1</p>
            <p>9.99€</p>
            <a class="btn btn-primary" href="produit?id=1">Détail</a>
            <button class="btn btn-success">Ajouter au panier</button>
        </div>
    </div>
</div>

<div class="col d-flex justify-content-center mt-5">
    <div class="card w-75 text-center">
        <h5 class="card-header">Nom produit 2</h5>
        <div class="card-body">
            <p>Nom produit 2</p>
            <p>Description produit 2</p>
            <p>14.99€</p>
            <a class="btn btn-primary" href="produit?id=2">Détail</a>
            <button class="btn btn-success">Ajouter au panier</button>
        </div>
    </div>
</div>

<?php require 'src/footer.php' ?>