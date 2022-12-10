<?php
    require_once './classes/connexionBDD.php';

    class Compte extends BDD{
        /* Récupère les informations d'un compte */
        public function getCompte($id){
            return self::requete('SELECT nom, prenom, pays, adresse, ville, codepostal, telephone, mail FROM compte WHERE id = :id', array('id' => $id));
        }

        public function checkmail($id){
            return self::requete('SELECT mail FROM compte WHERE NOT id = :id', array('id' => $id));
        }

        public function modifierInfos($id, $nom, $prenom, $email, $adresse, $telephone, $ville, $CP, $pays){
            self::requete('UPDATE compte SET pays = :pays, nom = :nom, prenom = :prenom, mail = :mail, adresse = :adresse, telephone = :telephone, ville = :ville, codepostal = :cp WHERE id = :id', array(
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'pays' => $pays,
                'adresse' => $adresse,
                'ville' => $ville,
                'cp' => $CP,
                'telephone' => $telephone,
                'mail' => $email,
                'pays' => $pays
            ));
        }

        public function checkMDP($id){
            return self::requete('SELECT mdp FROM compte WHERE id = :id', array('id' => $id));
        }

        public function changerMDP($id, $MDP){
            self::requete('UPDATE compte SET mdp = :mdp WHERE id = :id', array('id' => $id, 'mdp' => $MDP));
        }
    }
?>