<?php require 'src/header.php' ?>

<!-- barre de recherche -->
<div class="card w-25 ms-3">
  <h5 class="card-header">Recherche</h5>
  <div class="card-body">
    <form class="form-inline">
      <input class="from-control" type="search" placeholder="Rechercher" aria-label="Recherche">
      <button class="btn btn-outline-success" type="submit">Ok</button>
    </form>
  </div>
</div>

<!-- Catégorie -->
<div class="card w-25 ms-3 mt-3">
  <h5 class="card-header">Catégorie</h5>
  <div class="card-body">
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        Catégorie 1
        <span class="badge bg-primary round-pill">9</span>
      </a>
    </ul>
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        Catégorie 2
        <span class="badge bg-primary round-pill">53</span>
      </a>
    </ul>
    <ul class="list-group">
      <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
        Catégorie 3
        <span class="badge bg-primary round-pill">15</span>
      </a>
    </ul>
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

<?php require 'src/footer.php' ?>