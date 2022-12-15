<?php
    require_once './classes/connexionBDD.php';

    class Panier extends BDD{
        /* Vérifie l'existance d'un panier
        Paramètre d'entrée : l'id d'un compte
        Retourne : un panier ou vide
        */
        public function checkExistancePanier($idCompte){
            return self::requete('SELECT * FROM panier WHERE id_compte = :idCompte', array('idCompte' => $idCompte));
        }

        /* Créer un nouveau panier
        Paramètre d'entrée : l'id du compte
        Retourne : pas de retour
        */
        public function creerNouveauPanier($idCompte){
            self::requete('INSERT INTO panier (id_compte) VALUES (:idCompte)', array('idCompte' => $idCompte));
        }

        /* Obtient l'id d'un panier
        Paramètre d'entrée : l'id d'un compte
        Retourne : l'id du panier
        */
        public function getPanier($idCompte){
            return self::requete('SELECT id FROM panier WHERE id_compte = :idCompte', array('idCompte' => $idCompte));
        }

        /* Ajout un produit dans un panier ainsi que sa quantité
        Paramètres d'entrée : l'id du panier, l'id du produit et sa quantité
        Retourne : pas de retour
        */
        public function ajouterArticle($idPanier, $idProduit, $quantite){
            self::requete('INSERT INTO panier_produit (id_panier, id_produit, quantite) VALUES (:idPanier, :idProduit, :quantite)', array(
                'idPanier' => $idPanier,
                'idProduit' => $idProduit,
                'quantite' => $quantite
            ));
        }

        /* Vérifie l'existance d'un article dans le panier
        Paramètres d'entrée : l'id du panier, l'id du produit
        Retourne : un article ou vide
        */
        public function checkExistanceArticle($idPanier, $idProduit){
            return self::requete('SELECT * FROM panier_produit WHERE id_panier = :idPanier AND id_produit = :idProduit', array('idPanier' => $idPanier, 'idProduit' => $idProduit));
        }

        /* Ajout ou supprime la quantité d'un panier
        Paramètres d'entrée : l'id du panier, l'id du produit, la quantité, ajouter ou supprimer le nombres de quantités
        Retourne : pas de retour
        */
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

        /* Obtenir tous les informations de tous les articles d'un panier en fonction de l'id du compte
        Paramètre d'entrée : l'id d'un compte
        Retourne : une liste avec les informations des produits et l'id du panier
        */
        public function allArticles($idCompte){
            return self::requete('SELECT p.id AS idP, pr.*, pp.quantite, c.nom as nomC FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier INNER JOIN produit pr ON pp.id_produit = pr.id INNER JOIN categorie c ON pr.id_categorie = c.id WHERE p.id_compte = :idCompte', array('idCompte' => $idCompte));
        }

        /* Calcul le prix total
        Paramètre d'entrée : l'id d'un compte
        Retourne : le prix total du panier
        */
        public function prixTotal($idCompte){
            $prixTotal = 0;
            $tousArticles = self::requete('SELECT pr.*, pp.quantite, c.nom as nomC FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier INNER JOIN produit pr ON pp.id_produit = pr.id INNER JOIN categorie c ON pr.id_categorie = c.id WHERE p.id_compte = :idCompte', array('idCompte' => $idCompte));

            foreach($tousArticles as $unArticle){
                /* Si il y a une promotion en cours, appliquer le prix de la promotion */
                $promo = self::requete('SELECT ROUND((prod.prix * (100-prom.rabais)) / 100, 2) AS \'prixReduit\', prom.id_produit, prom.date_fin FROM produit prod INNER JOIN promotion prom ON prod.id = prom.id_produit WHERE prom.id_produit = :idProduit',array('idProduit' => $unArticle['id']));
                /* Sinon, appliquer le prix habituel */
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