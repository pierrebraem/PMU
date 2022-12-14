<?php
    require_once './classes/connexionBDD.php';

    class Panier extends BDD{
        public function checkExistancePanier($idCompte){
            return self::requete('SELECT * FROM panier WHERE id_compte = :idCompte', array('idCompte' => $idCompte));
        }

        public function creerNouveauPanier($idCompte){
            self::requete('INSERT INTO panier (id_compte) VALUES (:idCompte)', array('idCompte' => $idCompte));
        }

        public function getPanier($idCompte){
            return self::requete('SELECT id FROM panier WHERE id_compte = :idCompte', array('idCompte' => $idCompte));
        }

        public function ajouterArticle($idPanier, $idProduit, $quantite){
            self::requete('INSERT INTO panier_produit (id_panier, id_produit, quantite) VALUES (:idPanier, :idProduit, :quantite)', array(
                'idPanier' => $idPanier,
                'idProduit' => $idProduit,
                'quantite' => $quantite
            ));
        }

        public function checkExistanceArticle($idPanier, $idProduit){
            return self::requete('SELECT * FROM panier_produit WHERE id_panier = :idPanier AND id_produit = :idProduit', array('idPanier' => $idPanier, 'idProduit' => $idProduit));
        }

        public function modifierQuantite($idPanier, $idProduit, $quantite, $mode){
            $quantiteActuelle = self::requete('SELECT quantite FROM panier_produit WHERE id_panier = :idPanier AND id_produit = :idProduit', array('idPanier' => $idPanier, 'idProduit' => $idProduit))[0]['quantite'];
            if($mode == 'plus'){
                self::requete('UPDATE panier_produit SET quantite = :quantite WHERE id_panier = :idPanier AND id_produit = :idProduit', array(
                    'idPanier' => $idPanier,
                    'idProduit' => $idProduit,
                    'quantite' => $quantiteActuelle + $quantite
                ));
            }
            else{
                self::requete('UPDATE panier_produit SET quantite = :quantite WHERE id_panier = :idPanier AND id_produit = :idProduit', array(
                    'idPanier' => $idPanier,
                    'idProduit' => $idProduit,
                    'quantite' => $quantiteActuelle - $quantite
                ));
            }
        }

        public function allArticles($idCompte){
            return self::requete('SELECT p.id AS idP, pr.*, pp.quantite, c.nom as nomC FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier INNER JOIN produit pr ON pp.id_produit = pr.id INNER JOIN categorie c ON pr.id_categorie = c.id WHERE p.id_compte = :idCompte', array('idCompte' => $idCompte));
        }

        public function prixTotal($idCompte){
            $prixTotal = 0;
            $tousArticles = self::requete('SELECT pr.*, pp.quantite, c.nom as nomC FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier INNER JOIN produit pr ON pp.id_produit = pr.id INNER JOIN categorie c ON pr.id_categorie = c.id WHERE p.id_compte = :idCompte', array('idCompte' => $idCompte));

            foreach($tousArticles as $unArticle){
                $promo = self::requete('SELECT ROUND((prod.prix * (100-prom.rabais)) / 100, 2) AS \'prixReduit\', prom.id_produit, prom.date_fin FROM produit prod INNER JOIN promotion prom ON prod.id = prom.id_produit WHERE prom.id_produit = :idProduit',array('idProduit' => $unArticle['id']));;
                if(empty($promo)){
                    $prixTotal = $prixTotal + $unArticle['prix'] * $unArticle['quantite'];
                }
                else{
                    $prixTotal = $prixTotal + $promo[0]['prixReduit'] * $unArticle['quantite'];
                }
            }
            return $prixTotal;
        }

        public function supprimerArticle($idPanier, $idProduit){
            self::requete('DELETE FROM panier_produit WHERE id_panier = :idPanier AND id_produit = :idProduit', array('idPanier' => $idPanier, 'idProduit' => $idProduit));
        }

        public function checkPromotion($idProduit){
            return self::requete('SELECT ROUND((prod.prix * (100-prom.rabais)) / 100, 2) AS \'prixReduit\', prom.id_produit, prom.date_fin FROM produit prod INNER JOIN promotion prom ON prod.id = prom.id_produit WHERE prom.id_produit = :idProduit',array('idProduit' => $idProduit));
        }
    }
?>