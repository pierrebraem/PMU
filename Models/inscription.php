<?php
    require_once './classes/connexionBDD.php';

    class InscriptionM extends BDD{
        /* Variables */
        private $nom;
        private $prenom;
        private $pays;
        private $adresse;
        private $ville;
        private $cp;
        private $mail;
        private $telephone;
        private $mdp;

        /* Constructeur */
        public function __construct($nom, $prenom, $mail, $mdp, $pays, $adresse, $ville, $cp, $telephone){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mail = $mail;
            $this->mdp = $mdp;
            $this->pays = $pays;
            $this->telephone = $telephone;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->cp = $cp;
        }

        /* Insertion des données dans la BDD pour créer un nouvel utilisateur
        Paramètre d'entrée : aucun
        Retourne : pas de retour
        */
        public function insertion(){
            self::requete('INSERT INTO compte (nom, prenom, pays, adresse, ville, codepostal, telephone, mail, mdp) VALUES (:nom, :prenom, :pays, :adresse, :ville, :codepostal, :telephone, :mail, :mdp)', array(
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'pays' => $this->pays,
                'adresse' => $this->adresse,
                'ville' => $this->ville,
                'codepostal' => $this->cp,
                'telephone' => $this->telephone,
                'mail' => $this->mail,
                'mdp' => password_hash($this->mdp, PASSWORD_ARGON2I)
            ));
        }

        /* Récupère les adresses mails 
        Paramètre d'entrée : aucun
        Retourne : les adresses mails des comptes
        */
        public function checkmail(){
            return self::requete('SELECT mail FROM compte');
        }
    }
?>