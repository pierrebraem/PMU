<?php
    require_once './classes/connexionBDD.php';

    class Compte extends BDD{
        /* Récupère les informations d'un compte 
        Paramètre d'entrée : l'id du compte
        Retourne : les informations du compte
        */
        public function getCompte($id){
            return self::requete('SELECT nom, prenom, pays, adresse, ville, codepostal, telephone, mail FROM compte WHERE id = :id', array('id' => $id));
        }

        /* Récupère une adresse mail d'un compte existant
        Paramètre d'entrée : l'id du compte
        Retourne : l'adresse mail ou vide
        */
        public function checkmail($id){
            return self::requete('SELECT mail FROM compte WHERE NOT id = :id', array('id' => $id));
        }

        /* Modifie les informations d'un compte
        Paramètres d'entrée : l'id du compte et les nouvelles informations
        Retourne : pas de retour
        */
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

        /* Récupère le mot de passe d'un compte pour vérification 
        Paramètre d'entrée : l'id du compte
        Retourne : le mot de passe du compte
        */
        public function checkMDP($id){
            return self::requete('SELECT mdp FROM compte WHERE id = :id', array('id' => $id));
        }

        /* Change le mot de passe d'un compte
        Paramètres d'entrée : l'id du compte et le nouveau mot de passe
        Retourne : les informations du compte
        */
        public function changerMDP($id, $MDP){
            self::requete('UPDATE compte SET mdp = :mdp WHERE id = :id', array('id' => $id, 'mdp' => $MDP));
        }

        /* Récupère les commandes d'un compte
        Paramètre d'entrée : l'id du compte
        Retourne : les commandes du compte
        */
        public function getCommandes($idCompte){
            return self::requete('SELECT * FROM commande WHERE id_compte = :idCompte', array('idCompte' => $idCompte));
        }
    }
?>