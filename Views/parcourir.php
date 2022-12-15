<!--
Affiche la liste des produits
Affiche le détail des produits
-->
<?php 
    require_once 'src/header.php';
    require_once './models/produit.php';
    $produit = new Produit();

    /* Liste des promotions */
    $tousPromotions = $produit->getPromotions();

    /* Récupère la liste des produits en fonction de la recherche */
    if(isset($_GET['search'])){
        $tousProduits = $produit->recherche($_GET['search']);
    }
    /* Récupère les informations du produit */
    elseif(isset($_GET['id'])){
        $unProduit = $produit->getProduit($_GET['id']);
    }
    /* Récupère tous les produits */
    else{
        $tousProduits = $produit->allProduits();
    }
?>

<!-- Affiche les informations d'un produit -->
<?php if(isset($_GET['id'])) : ?>
    <div class="col d-flex justify-content-center">
        <div class="card w-75 text-center">
        <img class="card-img-top" src="<?php echo($unProduit[0]['image']) ?>">
        <div class="card-body">
            <p><?php echo($unProduit[0]['nomp']) ?></p>
            <p><?php echo($unProduit[0]['description']) ?></p>
            <?php $boolPromotion = false; ?>
                <?php foreach($tousPromotions as $unePromotion): ?>
                    <?php if($_GET['id'] == $unePromotion['id_produit']): ?>
                        <p>Était à : <?php echo($unProduit[0]['prix']); ?>€</p>
                        <p>Est à : <?php echo($unePromotion['prixReduit']); ?>€</p>
                        <p>Fin de la promotion : <?php echo($unePromotion['date_fin']); ?>
                    <?php $boolPromotion = true; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if($boolPromotion == false): ?>
                    <p><?php echo($unProduit[0]['prix']) ?>€</p>
                <?php endif; ?>
            <p><?php echo($unProduit[0]['nomc']) ?></p>
            <div class="pt-2">
                <form action="panier/ajouter" method="post">
                    <input type="hidden" name="id" value="<?php echo($_GET['id']); ?>">
                    <div class="col d-flex justify-content-center pb-2">
                        <input type="number" class="form-control w-25" name="quantite" value="1">
                    </div>
                    <button class="btn btn-success" type="submit">Ajouter au panier</button>
                </form>
            </div>
        </div>
        <div class="text-center pt-2">
            <a class="btn btn-primary" href="./parcourir">Retour</a>
        </div>
    </div>
<!-- Affiche la liste des produits -->
<?php else: ?>
    <!-- Barre de recherche -->
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

    <!-- Liste des produits -->
    <?php foreach($tousProduits as $unProduit): ?>
        <div class="col d-flex justify-content-center mt-5">
            <div class="card w-75 text-center">
                <h5 class="card-header"><?php echo($unProduit['nom']) ?></h5>
                <div class="card-body">
                    <p><?php echo($unProduit['nom']) ?></p>
                    <p><?php echo($unProduit['description']) ?></p>
                    <?php $boolPromotion = false; ?>
                    <!-- Vérifie si il y a une promotion en cours pour le produit -->
                    <?php foreach($tousPromotions as $unePromotion): ?>
                        <?php if($unProduit['id'] == $unePromotion['id_produit']): ?>
                            <p>Était à : <?php echo($unProduit['prix']); ?>€</p>
                            <p>Est à : <?php echo($unePromotion['prixReduit']); ?>€</p>
                            <p>Fin de la promotion : <?php echo($unePromotion['date_fin']); ?>
                            <?php $boolPromotion = true; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($boolPromotion == false): ?>
                        <p><?php echo($unProduit['prix']) ?>€</p>
                    <?php endif; ?>
                    <form action="parcourir/detail" method="post">
                        <input type="hidden" name="id" value="<?php echo($unProduit['id']) ?>">
                        <button class="btn btn-primary" type="submit">Détail</button>
                    </form>
                    <div class="pt-2">
                        <form action="panier/ajouter" method="post">
                            <input type="hidden" name="id" value="<?php echo($unProduit['id']) ?>">
                            <div class="col d-flex justify-content-center pb-2">
                                <input type="number" class="form-control w-25" name="quantite" value="1">
                            </div>
                            <button class="btn btn-success" type="submit">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once 'src/footer.php' ?>