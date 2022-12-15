<!-- Affichage de la page d'accueil -->
<?php 
require_once 'src/header.php';
require_once './models/categorie.php';
require_once './models/conseil.php';
require_once './models/produit.php';

$categorie = new Categorie();
$conseil = new Conseil();
$produit = new Produit();

/* Liste des 3 catégories */
$listeCategories = $categorie->allCategories();

/* Liste des conseils */
$listeConseils = $conseil->allConseils();

/* Liste des produits en promotions */
$listeProduits = $produit->getPromotions();
?>

<!-- barre de recherche et promotion et dernières ventes -->
<div class="container ms-2 mt-3 w-100">
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <h5 class="card-header">Recherche</h5>
        <div class="card-body">
          <form action="parcourir/search" method="post" class="form-inline">
            <input class="from-control" type="search"name="nom" placeholder="Rechercher" aria-label="Recherche">
            <button class="btn btn-outline-success" type="submit">Ok</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-4 ms-5">
      <div class="card h-100">
        <div class="card-body">
          <?php foreach($listeProduits as $unProduit): ?>
            <ul class="list-group">
              <p><?php echo($unProduit['nom']); ?></p>
              <p><?php echo($unProduit['prixReduit']); ?>€ au lieu de <?php echo($unProduit['prix']); ?></p>
            </ul>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="col-lg-3 ms-5">
      <div class="card h-100">
        <h5 class="card-header">Dernières ventes</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Vente n°1</li>
          <li class="list-group-item">Vente n°2</li>
          <li class="list-group-item">Vente n°3</li>
          <li class="list-group-item">Vente n°4</li>
        </ul>
      </div>
    </div>
  </div>
</div>


<!-- Catégorie -->
<div class="card w-25 ms-3 mt-3">
  <h5 class="card-header">Catégorie</h5>
  <div class="card-body">
    <?php foreach($listeCategories as $uneCategorie): ?>
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        <?php echo($uneCategorie['nom']); ?>
        <span class="badge bg-primary round-pill"><?php echo($uneCategorie['nombre']); ?></span>
      </a>
    </ul>
    <?php endforeach; ?>
  </div>
</div>

<!-- Conseil -->
<div class="card w-25 ms-3 mt-3">
  <h5 class="card-header">Conseil</h5>
  <div class="card-body">
    <?php foreach($listeConseils as $unConseil): ?>
    <ul class="list-group">
      <form action="conseil/detail" method="post">
        <input type="hidden" name="id" value="<?php echo($unConseil['id']) ?>">
        <button class="list-group-item d-flex justify-content-between align-items-center" type="sumbit"><?php echo($unConseil['nom']); ?></button>
      </form>
    </ul>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once 'src/footer.php' ?>