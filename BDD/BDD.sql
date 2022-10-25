-- Création de la base de données
DROP DATABASE IF EXISTS pmu;
CREATE DATABASE pmu;
USE pmu;

-- Création des tables
-- Création de la table "categorie"
CREATE TABLE categorie(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(25) NOT NULL
);

-- Création de la table "produit"
CREATE TABLE produit(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description longtext NOT NULL,
    prix DECIMAL(6, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    id_categorie INT NOT NULL
);

-- Création de la table "compte"
CREATE TABLE compte(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    pays VARCHAR(50) NULL,
    adresse VARCHAR(100) NULL,
    ville VARCHAR(50) NULL,
    codepostal VARCHAR(10) NULL,
    telephone VARCHAR(16) NULL,
    mail VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL
);

-- Création de la table "conseil"
CREATE TABLE conseil(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    description longtext NOT NULL,
    image VARCHAR(255) NULL
);

-- Création de la table "conseil_produit"
CREATE TABLE conseil_produit(
    id_conseil INT NOT NULL,
    id_produit INT NOT NULL,
    quantite INT NOT NULL,
    PRIMARY KEY(id_conseil, id_produit)
);

-- Création de la table "panier"
CREATE TABLE panier(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_compte INT NOT NULL
);

-- Création de la table "panier_produit"
CREATE TABLE panier_produit(
    id_panier INT NOT NULL,
    id_produit INT NOT NULL,
    quantite INT NOT NULL,
    PRIMARY KEY(id_panier, id_produit)
);

-- Création de la table "commande"
CREATE TABLE commande(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    pays VARCHAR(50) NOT NULL,
    adresse VARCHAR(100) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    codepostal VARCHAR(10) NOT NULL,
    date DATE NOT NULL
);

-- Création de la table "commande_produit"
CREATE TABLE commande_produit(
    id_commande INT NOT NULL,
    id_produit INT NOT NULL,
    quantite INT NOT NULL,
    PRIMARY KEY(id_commande, id_produit)
);

-- Création de la table "promotion"
CREATE TABLE promotion(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date_fin DATE NOT NULL,
    rabais INT NOT NULL,
    id_produit INT NOT NULL
);

-- Création des clés étrangères
-- Création de la clé étrangère pour "produit"
ALTER TABLE produit
ADD FOREIGN KEY (id_categorie) REFERENCES categorie(id);

-- Création des clés étrangères pour "conseil_produit"
ALTER TABLE conseil_produit
ADD FOREIGN KEY (id_conseil) REFERENCES conseil(id),
ADD FOREIGN KEY (id_produit) REFERENCES produit(id);

-- Création des clés étrangères pour "panier_produit"
ALTER TABLE panier_produit
ADD FOREIGN KEY (id_panier) REFERENCES panier(id),
ADD FOREIGN KEY (id_produit) REFERENCES produit(id);

-- Création des clés étrangères pour "commande_produit"
ALTER TABLE commande_produit
ADD FOREIGN KEY (id_commande) REFERENCES commande(id),
ADD FOREIGN KEY (id_produit) REFERENCES produit(id);

-- Création de la clé étrangère pour "promotion"
ALTER TABLE promotion
ADD FOREIGN KEY (id_produit) REFERENCES produit(id);