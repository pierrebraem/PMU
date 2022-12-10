<?php 
    require_once 'src/header.php';
?>

<?php
    if(empty($_SESSION)):
        header('Location: ./connexion');
    else:
?>
<section class="h-100">
    <div class="container py-3">
        <div class="row d-flex justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h5>Panier</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="#">
                        </div>
                        <div class="col">
                           <p>Nom : montBC6</p>
                           <p>Description : montBC6</p>
                           <p>Catégorie : Test</p>
                        </div>
                        <div class="col">
                            <p>Quantité : 3</p>
                        </div>
                        <div class="col">
                            <p>14,99€</p>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img src="#">
                        </div>
                        <div class="col">
                           <p>Nom : montBC13</p>
                           <p>Description : montBC13</p>
                           <p>Catégorie : Test</p>
                        </div>
                        <div class="col">
                            <p>Quantité : 2</p>
                        </div>
                        <div class="col">
                            <p>9,99€</p>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
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