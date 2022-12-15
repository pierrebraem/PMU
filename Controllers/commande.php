<?php
require_once './controllers/controller.php';
require_once './models/commande.php';
require_once './includes/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class CommandeController extends Controller{
    public static function commander(){
        /* Récupère les données du POST */
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $pays = $_POST['pays'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $cp = $_POST['cp'];
        $erreur = false;

        $commande = new Commande();

        /* Gestion d'erreurs */
        if($nom == "" || $prenom == "" || $email == "" || $telephone == "" || $adresse == "" || $ville == "" || $cp == ""){
            header('Location: ../commande?etat=Enull');
            $erreur = true;
            die();
        }

        if($pays == "none"){
            header('Location: ../commande?etat=Epays');
            $erreur = true;
            die();
        }

        if($erreur == false){
            $commande->setCommande($commande->getContenusPanier($_SESSION['id']), $_SESSION['id'], $nom, $prenom, $email, $telephone, $pays, $adresse, $ville, $cp);
            $commande->supprimerPanier($_SESSION['id']);
            header('Location: ../commande?acheter=true&commande_id='.$commande->getLastCommande()[0]['id']);
            die();
        }
    }

    public static function telechargerPDF(){
        $idCommande = $_POST['id'];

        $commande = new Commande();

        $infosCommande = $commande->getInfosCommande($idCommande);
        $contenusCommande = $commande->getContenusCommande($idCommande);
        $prixTotal = $commande->prixTotal($idCommande);
        
        /* Génération du code HTML pour le PDF */
        $html = '<!DOCTYPE html>'
        .'<html lang="fr">'
            .'<head>'
                .'<meta charset="UTF-8">'
                .'<title>Commande du '.$infosCommande[0]['date'].'</title>'
            .'</head>'
            .'<body>'
                .'<h1>Informations</h1>'
                .'<p>Nom : '.$infosCommande[0]['nom'].'</p>'
                .'<p>Prénom : '.$infosCommande[0]['prenom'].'</p>'
                .'<p>Adresse : '.$infosCommande[0]['adresse'].' '.$infosCommande[0]['codepostal'].', '.$infosCommande[0]['ville'].', '.$infosCommande[0]['pays'].'</p>'

                .'<h1>Récapitulative de la commande</h1>'
                .'<table>'
                    .'<thead>'
                        .'<th>Image</th>'
                        .'<th>Nom</th>'
                        .'<th>Description</th>'
                        .'<th>Quantité</th>'
                        .'<th>Prix</th>'
                    .'</thead>'
                    .'<tbody>';
                    foreach($contenusCommande as $uneCommande){
                        $html .= '<tr>'
                            .'<td><img src="'.$uneCommande['image'].'"></td>'
                            .'<td>'.$uneCommande['nom'].'</td>'
                            .'<td>'.$uneCommande['description'].'</td>'
                            .'<td>'.$uneCommande['quantite'].'</td>'
                            .'<td>'.$uneCommande['prix'].'</td>'
                        .'<tr>';
                    }
                    $html .= '</tbody>'
                .'</table>'
                .'<p>Prix total : '.$prixTotal.'€</p>'
            .'</body>'
        .'</html>';

        /* Génération pdf */

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('commande du '.$infosCommande[0]['date']);
    }
}
?>