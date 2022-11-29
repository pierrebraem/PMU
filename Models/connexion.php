<?php
    require_once './classes/connexionBDD.php';

    class ConnexionM extends BDD{
        /* Variables */
        private $email;
        private $mdp;

        /* Constructeur */
        public function __construct($email, $mdp){
            $this->$email =$email;
            $this->$mdp = password_hash($mdp, PASSWORD_ARGON2I);
        }

        /* Récupère l'adresse mail et le mdp */
        public function checkconnexion($email){
            return self::requete('SELECT id, mail, mdp FROM compte WHERE mail = :mail', array('mail' => $email));
        }
    }
?>