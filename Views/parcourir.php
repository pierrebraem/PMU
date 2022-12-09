<?php 
    require_once 'src/header.php';
    require_once './models/produit.php';
    $produit = new Produit();
    if(isset($_GET['search'])){
        $tousProduits = $produit->recherche($_GET['search']);
    }
    elseif(isset($_GET['id'])){
        $unProduit = $produit->getProduit($_GET['id']);
    }
    else{
        $tousProduits = $produit->allProduits();
    }
?>

<?php if(isset($_GET['id'])) : ?>
    <div class="col d-flex justify-content-center">
        <div class="card w-75 text-center">
        <img class="card-img-top" src="<?php echo($unProduit[0]['image']) ?>">
        <div class="card-body">
            <p><?php echo($unProduit[0]['nomp']) ?></p>
            <p><?php echo($unProduit[0]['description']) ?></p>
            <p><?php echo($unProduit[0]['prix']) ?></p>
            <p><?php echo($unProduit[0]['nomc']) ?></p>
            <div class="pt-2">
                <button class="btn btn-success">Ajouter au panier</button>
            </div>
        </div>
        <div class="text-center pt-2">
            <a class="btn btn-primary" href="./parcourir">Retour</a>
        </div>
    </div>
<?php else: ?>
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
                    <form action="parcourir/detail" method="post">
                        <input type="hidden" name="id" value="<?php echo($unProduit['id']) ?>">
                        <button class="btn btn-primary" type="submit">Détail</button>
                    </form>
                    <div class="pt-2">
                        <button class="btn btn-success">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require 'src/footer.php' ?>