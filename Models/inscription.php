<?php
    class InscriptionM{
        /* Variables */
        private $nom;
        private $prenom;
        private $pays;
        private $adresse;
        private $ville;
        private $CP;
        private $mail;
        private $mdp;

        /* Constructeur */
        function __construct($nom, $prenom, $mail, $mdp, $pays, $adresse, $ville, $CP){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mail = $mail;
            $this->mdp = $mdp;
            $this->pays = $pays;
            $this->adresse = $adresse;
            $this->ville = $ville;
            $this->CP = $CP;
        }

        /* Geter et seter de nom */
        public function setNom($nom){
            $this->nom = $nom;
        }

        public function getNom(){
            return $nom;
        }

        /* Geter et seter de prénom */
        public function setPrenom($prenom){
            $this->prenom = $prenom;
        }

        public function getPrenom(){
            return $prenom;
        }

        /* Geter et seter de mail */
        public function setMail($mail){
            $this->mail = $mail;
        }

        public function getMail(){
            return $mail;
        }

        /* Geter et seter de mdp */
        public function setMdp($mdp){
            $this->mdp = $mdp;
        }

        public function getMdp(){
            return $mdp;
        }

        /* Geter et seter de pays */
        public function setPays($pays){
            $this->pays = $pays;
        }

        public function getPays(){
            return $pays;
        }

        /* Geter et seter de adresse */
        public function setAdresse($adresse){
            $this->adresse = $adresse;
        }

        public function getAdresse(){
            return $adresse;
        }

        /* Geter et seter de ville */
        public function setVille($ville){
            $this->ville = $ville;
        }

        public function getVille(){
            return $ville;
        }

        /* Geter et seter de CP */
        public function setCP($CP){
            $this->CP = $CP;
        }

        public function getCP(){
            return $CP;
        }
    }
?>