<?php 
    require_once 'src/header.php';
    require_once './models/produit.php';
    $produit = new Produit();
    if(isset($_GET['search'])){
        $tousProduits = $produit->recherche($_GET['search']);
    }
    else{
        $tousProduits = $produit->allProduits();
    }
?>

<div class="col d-flex justify-content-center">
    <div class="card w-75 text-center">
        <h5 class="card-header">Recherche</h5>
        <div class="card-body">
            <form action="parcourir/search" method="post" class="form-inline">
                <input class="from-control" type="search" name="nom" placeholder="Rechercher" aria-label="Recherche">
                <button class="btn btn-outline-success" type="submit">Ok</button>
            </form>
        </div>
    </div>
</div>

<?php foreach($tousProduits as $unProduit): ?>
    <div class="col d-flex justify-content-center mt-5">
        <div class="card w-75 text-center">
            <h5 class="card-header"><?php echo($unProduit['nom']) ?></h5>
            <div class="card-body">
                <p><?php echo($unProduit['nom']) ?></p>
                <p><?php echo($unProduit['description']) ?></p>
                <p><?php echo($unProduit['prix']) ?>€</p>
                <a class="btn btn-primary" href="produit?id=<?php echo($unProduit['id']) ?>">Détail</a>
                <button class="btn btn-success">Ajouter au panier</button>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?php require 'src/footer.php' ?>