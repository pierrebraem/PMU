<!-- Affichage de la page d'accueil -->
<?php 
require_once 'src/header.php';
require_once './models/categorie.php';

$categorie = new Categorie();
/* Affiche liste des 3 catégories */
$listeCategories = $categorie->allCategories()
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
          Afficher les promotions
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
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        Conseil
      </a>
    </ul>
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        Conseil 2
      </a>
    </ul>
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        Conseil 3
      </a>
    </ul>
  </div>
</div>

<?php require_once 'src/footer.php' ?>