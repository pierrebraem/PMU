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
                                    <p><?php echo($unArticle['prix']); ?>€</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-danger">Supprimer</a>
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
                                <p>Prix : 24,98€</p>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-success">Payer</a>
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