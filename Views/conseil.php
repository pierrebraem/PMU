<?php 
    require_once 'src/header.php';
    require_once './models/conseil.php';
    $conseil = new Conseil();
    $tousConseils = $conseil->allConseils();
?>

<div class="col d-flex justify-content-center">
    <div class="card w-75 text-center">
        <h5 class="card-header">Recherche</h5>
        <div class="card-body">
            <form class="form-inline">
                <input class="from-control" type="search" placeholder="Rechercher" aria-label="Recherche">
                <button class="btn btn-outline-success" type="submit">Ok</button>
            </form>
        </div>
    </div>
</div>

<?php foreach($tousConseils as $unConseil): ?>
    <div class="col d-flex justify-content-center mt-5">
        <div class="card w-75 text-center">
            <h5 class="card-header"><?php echo($unConseil['nom']); ?></h5>
            <div class="card-body">
                <p><?php echo($unConseil['nom']); ?></p>
                <p><?php echo($unConseil['description']); ?></p>
                <a class="btn btn-primary" href="conseil?id=<?php echo($unConseil['id']) ?>">Détail</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php require 'src/footer.php' ?>