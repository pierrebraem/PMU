<?php 
    require_once 'src/header.php';
    require_once './models/panier.php';
    $panier = new Panier();
?>

<?php
    if(empty($_SESSION)):
        header('Location: ./connexion');
    else:
        $tousArticles = $panier->allArticles($_SESSION['id']);
?>
<section class="h-100">
    <div class="container py-3">
        <div class="row d-flex justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h5>Panier</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($tousArticles)): ?>
                        <p>Aucun article n'est présent dans le panier</p>
                    <?php else: ?>
                        <?php foreach($tousArticles as $unArticle): ?>
                            <div class="row">
                                <div class="col">
                                    <img src="<?php echo($unArticle['image']); ?>">
                                </div>
                                <div class="col">
                                <p>Nom : <?php echo($unArticle['nom']); ?></p>
                                <p>Description : <?php echo($unArticle['description']); ?></p>
                                <p>Catégorie : <?php echo($unArticle['nomC']); ?></p>
                                </div>
                                <div class="col">
                                    <p>Quantité : <?php echo($unArticle['quantite']); ?></p>
                                </div>
                                <div class="col">
                                    <?php $promo = $panier->checkPromotion($unArticle['id']); ?>
                                    <?php if(empty($promo)): ?>
                                        <p><?php echo($unArticle['prix']); ?>€</p>
                                    <?php else: ?>
                                        <p>Était à : <?php echo($unArticle['prix']); ?>€</p>
                                        <p>Est à : <?php echo($promo[0]['prixReduit'])?>€</p>
                                        <p>Fin de la promotion : <?php echo($promo[0]['date_fin']) ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <form action="panier/supprimer" method="post">
                                        <input type="hidden" name="idPanier" value="<?php echo($unArticle['idP']); ?>">
                                        <input type="hidden" name="idProduit" value="<?php echo($unArticle['id']); ?>">
                                        <button class="btn btn-danger" type="submit">Supprimer</a>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pt-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Prix total</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p>Prix : <?php echo($panier->prixTotal($_SESSION['id'])); ?>€</p>
                            </div>
                            <div class="col">
                                <?php if($panier->prixTotal($_SESSION['id']) != 0): ?>
                                    <a href="./commande" class="btn btn-success">Payer</a>
                                <?php else: ?>
                                    <a class="btn btn-success disabled">Payer</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require 'src/footer.php' ?>