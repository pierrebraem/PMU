<?php
    require_once './classes/connexionBDD.php';

    class Commande extends BDD{
        public function getContenusPanier($idCompte){
            return self::requete('SELECT pp.id_produit, pp.quantite FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier WHERE p.id_compte = :id', array('id' => $idCompte));
        }

        public function setCommande($listePanier, $idCompte, $nom, $prenom, $email, $telephone, $pays, $adresse, $ville, $cp){
            self::requete('INSERT INTO commande(nom, prenom, pays, adresse, ville, codepostal, date, id_compte) VALUES (:nom, :prenom, :pays, :adresse, :ville, :codepostal, NOW(), :idCompte)', array(
                'nom' => $nom,
                'prenom' => $prenom,
                'pays' => $pays,
                'adresse' => $adresse,
                'ville' => $ville,
                'codepostal' => $cp,
                'idCompte' => $idCompte
            ));

            $idCommande = self::requete('SELECT MAX(id) AS id FROM commande')[0]['id'];

            foreach($listePanier as $article){
                $prix = self::requete('SELECT ROUND((prod.prix * (100-prom.rabais)) / 100, 2) AS \'prixReduit\' FROM produit prod INNER JOIN promotion prom ON prod.id = prom.id_produit WHERE id_produit = :idProduit', array('idProduit' => $article['id_produit']))[0]['prixReduit'];
                
                if(empty($prix)){
                    $prix = self::requete('SELECT prix FROM produit WHERE id = :id', array('id' => $article['id_produit']))[0]['prix'];
                }
                self::requete('INSERT INTO commande_produit (id_commande, id_produit, quantite, prix) VALUES(:idCommande, :idProduit, :quantite, :prix)', array(
                    'idCommande' => $idCommande,
                    'idProduit' => $article['id_produit'],
                    'quantite' => $article['quantite'],
                    'prix' => $prix
                ));
            }
        }

        public function supprimerPanier($idCompte){
            $idPanier = self::requete('SELECT id FROM panier WHERE id_compte = :idCompte', array('idCompte' => $idCompte))[0]['id'];
            self::requete('DELETE FROM panier_produit WHERE id_panier = :id', array('id' => $idPanier));
            self::requete('DELETE FROM panier WHERE id = :id', array('id' => $idPanier));
        }

        public function getInfosCommande($idCommande){
            return self::requete('SELECT * FROM commande WHERE id = :idCommande', array('idCommande' => $idCommande));
        }

        public function getContenusCommande($idCommande){
            return self::requete('SELECT p.image, p.nom, p.description, cp.quantite, cp.prix FROM commande_produit cp INNER JOIN produit p ON cp.id_produit = p.id WHERE cp.id_commande = :idCommande', array('idCommande' => $idCommande));
        }

        public function prixTotal($idCommande){
            $prixTotal = 0;
            $tousArticles = self::requete('SELECT prix, quantite FROM commande_produit WHERE id_commande = :idCommande', array('idCommande' => $idCommande));

            foreach($tousArticles as $unArticle){
                $prixTotal = $prixTotal + $unArticle['prix'] * $unArticle['quantite'];
            }

            return $prixTotal;
        }
    }
?>