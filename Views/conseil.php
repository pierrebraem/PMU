<!-- 
Affiche tous les conseils
Affiche les détails d'un conseil
-->
<?php 
    require_once 'src/header.php';
    require_once './models/conseil.php';
    $conseil = new Conseil();

    /* Récupère les résultats de la recherche */
    if(isset($_GET['search'])){
        $tousConseils = $conseil->recherche($_GET['search']);
    }
    /* Récupère les informations d'un conseil */
    elseif(isset($_GET['id'])){
        $unConseil = $conseil->getConseil($_GET['id']);
        $tousProduits = $conseil->allProduits($_GET['id']);
    }
    /* Récupère tous les conseils */
    else{
        $tousConseils = $conseil->allConseils();
    }
?>

<!-- Affiche les détails d'un conseil -->
<?php if(isset($_GET['id'])): ?>
    <div class="col d-flex justify-content-center">
        <div class="card w-75 text-center">
            <img class="card-img-top" src="<?php echo($unConseil[0]['image']) ?>">
            <div class="card-body">
                <p><?php echo($unConseil[0]['nom']) ?></p>
                <p><?php echo($unConseil[0]['description']) ?></p>
            </div>
        </div>
    </div>
    <div class="col d-flex justify-content-center mt-5">
        <div class="card w-75 text-center">
            <h5 class="card-head">Listes des pièces utilisées</h5>
            <div class="card-body">
                <?php foreach($tousProduits as $unProduit): ?>
                    <a href="./parcourir?id=<?php echo($unProduit['id']) ?>"><?php echo($unProduit['nom']) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="text-center pt-2">
        <a class="btn btn-primary" href="./conseil">Retour</a>
    </div>
<!-- Affiche tous les conseils -->
<?php else: ?>
    <!-- Barre de recherche -->
    <div class="col d-flex justify-content-center">
        <div class="card w-75 text-center">
            <h5 class="card-header">Recherche</h5>
            <div class="card-body">
                <form action="conseil/search" method="post" class="form-inline">
                    <input class="from-control" type="search" name="nom" placeholder="Rechercher" aria-label="Recherche">
                    <button class="btn btn-outline-success" type="submit">Ok</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Les conseils -->
    <?php foreach($tousConseils as $unConseil): ?>
        <div class="col d-flex justify-content-center mt-5">
            <div class="card w-75 text-center">
                <h5 class="card-header"><?php echo($unConseil['nom']); ?></h5>
                <div class="card-body">
                    <p><?php echo($unConseil['nom']); ?></p>
                    <p><?php echo($unConseil['description']); ?></p>
                    <form action="conseil/detail" method="post">
                        <input type="hidden" name="id" value="<?php echo($unConseil['id']) ?>">
                        <button class="btn btn-primary" type="submit">Détail</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once 'src/footer.php' ?>