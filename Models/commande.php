<?php
    require_once './classes/connexionBDD.php';

    class Commande extends BDD{
        /* Variables */
        private $nom;
        private $prenom;
        private $email;
        private $telephone;
        private $pays;
        private $adresse;
        private $ville;
        private $cp;

        /* Constructeur */
        public function __construct($nom, $prenom, $email, $telephone, $pays, $adresse, $ville, $cp){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->telephone = $telephone;
            $this->pays = $pays;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->cp = $cp;
        }

        public function getContenusPanier($idCompte){
            return self::requete('SELECT pp.id_produit, pp.quantite FROM panier p INNER JOIN panier_produit pp ON p.id = pp.id_panier WHERE p.id_compte = :id', array('id' => $idCompte));
        }

        public function setCommande($listePanier, $idCompte){
            self::requete('INSERT INTO commande(nom, prenom, pays, adresse, ville, codepostal, date, id_compte) VALUES (:nom, :prenom, :pays, :adresse, :ville, :codepostal, NOW(), :idCompte)', array(
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'pays' => $this->pays,
                'adresse' => $this->adresse,
                'ville' => $this->ville,
                'codepostal' => $this->cp,
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
    }
?>