<?php
    require_once './classes/connexionBDD.php';

    class Commande extends BDD{
        /* Récupère tous les articles d'un panier
        Pamamètre d'entrée : id du compte qu'on souhaite récupérer le contenu du panier
        Retourne : l'id des produits ainsi que ça quantité
        */
        public function getContenusPanier($idCompte){
            return self::requete('SELECT pp.id_produit, pp.quantite FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier WHERE p.id_compte = :id', array('id' => $idCompte));
        }

        /* Enregistre une commande dans la base de données
        Pamamètres d'entrée : liste des articles dans le panier et les informations de livraison
        Retourne : pas de retour
        */
        public function setCommande($listePanier, $idCompte, $nom, $prenom, $email, $telephone, $pays, $adresse, $ville, $cp){
            /* Enregistre les informations de livraison dans la table "commande */
            self::requete('INSERT INTO commande(nom, prenom, pays, adresse, ville, codepostal, date, id_compte) VALUES (:nom, :prenom, :pays, :adresse, :ville, :codepostal, NOW(), :idCompte)', array(
                'nom' => $nom,
                'prenom' => $prenom,
                'pays' => $pays,
                'adresse' => $adresse,
                'ville' => $ville,
                'codepostal' => $cp,
                'idCompte' => $idCompte
            ));

            /* Récupère l'id de la commande qu'il vient d'être créer */
            $idCommande = self::requete('SELECT MAX(id) AS id FROM commande')[0]['id'];

            /* Parcours les articles dans le panier */
            foreach($listePanier as $article){
                /* Si il existe une promotion, calcule le prix réduit */
                $prix = self::requete('SELECT ROUND((prod.prix * (100-prom.rabais)) / 100, 2) AS \'prixReduit\' FROM produit prod INNER JOIN promotion prom ON prod.id = prom.id_produit WHERE id_produit = :idProduit', array('idProduit' => $article['id_produit']))[0]['prixReduit'];
                
                /* Sinon, récupère le prix normal */
                if(empty($prix)){
                    $prix = self::requete('SELECT prix FROM produit WHERE id = :id', array('id' => $article['id_produit']))[0]['prix'];
                }
                /* Enregistre l'article du panier dans la table commande_produit */
                self::requete('INSERT INTO commande_produit (id_commande, id_produit, quantite, prix) VALUES(:idCommande, :idProduit, :quantite, :prix)', array(
                    'idCommande' => $idCommande,
                    'idProduit' => $article['id_produit'],
                    'quantite' => $article['quantite'],
                    'prix' => $prix
                ));
            }
        }

        /* Supprime le contenu du panier et le panier lui-même après la validation d'une commande
        Pamamètre d'entrée : id du compte à supprimer le panier
        Retourne : pas de retour
        */
        public function supprimerPanier($idCompte){
            $idPanier = self::requete('SELECT id FROM panier WHERE id_compte = :idCompte', array('idCompte' => $idCompte))[0]['id'];
            self::requete('DELETE FROM panier_produit WHERE id_panier = :id', array('id' => $idPanier));
            self::requete('DELETE FROM panier WHERE id = :id', array('id' => $idPanier));
        }

        /* Obtient l'id de la dernière commande enregistrée
        Pamamètre d'entrée : aucun
        Retourne : pas de retour
        */
        public function getLastCommande(){
            return self::requete('SELECT MAX(id) AS id FROM commande');
        }

        /* Obtient les informations d'une commande
        Pamamètre d'entrée : l'id de la commande
        Retourne : les informations de la commande
        */
        public function getInfosCommande($idCommande){
            return self::requete('SELECT * FROM commande WHERE id = :idCommande', array('idCommande' => $idCommande));
        }

        /* Obtient les produits d'une commande
        Pamamètre d'entrée : l'id de la commande
        Retourne : la liste des produits dans la commande
        */
        public function getContenusCommande($idCommande){
            return self::requete('SELECT p.image, p.nom, p.description, cp.quantite, cp.prix FROM commande_produit cp INNER JOIN produit p ON cp.id_produit = p.id WHERE cp.id_commande = :idCommande', array('idCommande' => $idCommande));
        }

        /* Obtient le prix total d'une commande
        Pamamètre d'entrée : l'id de la commande
        Retourne : le prix total d'une commande
        */
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