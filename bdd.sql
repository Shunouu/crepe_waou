-- MySQL Script généré par MySQL Workbench
-- 12/12/24 15:00:00

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

USE crepe_waou;

-- -----------------------------------------------------
-- Table `home`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `home`;

CREATE TABLE `home` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT 'Nom de la section sur la page d''accueil',
  `description` text COMMENT 'Description de la section',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création de la section',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Date de la dernière mise à jour de la section',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- Table `category`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE IF NOT EXISTS `category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL COMMENT 'Nom de la catégorie',
  `picture` VARCHAR(128) NULL COMMENT 'URL de l\'image de la catégorie',
  `home_order` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Ordre d\'affichage sur la page d\'accueil',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création de la catégorie',
  `updated_at` TIMESTAMP NULL COMMENT 'Date de la dernière mise à jour de la catégorie',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `artiste` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
'

-- -----------------------------------------------------
-- Table de connexion (login)
-- -----------------------------------------------------

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL COMMENT 'Email de l''utilisateur',
  `password` varchar(255) NOT NULL COMMENT 'Mot de passe crypté',
  `role` enum('admin','user') NOT NULL COMMENT 'Rôle de l''utilisateur (admin ou utilisateur)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du compte',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Date de la dernière mise à jour du compte',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; 

-- -----------------------------------------------------
-- Table `formulaire`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `formulaire`;
CREATE TABLE `formulaire` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL COMMENT 'Nom du client',
  `prénom` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'Email du client',
  `password` varchar(255) NOT NULL COMMENT 'Mot de passe du client',
  `adresse` varchar(255) NOT NULL COMMENT 'Adresse du client',
  `ville` varchar(128) NOT NULL COMMENT 'Ville du client',
  `code_postal` varchar(20) NOT NULL COMMENT 'Code postal du client',
  `newsletter` tinyint(1) DEFAULT '0' COMMENT 'Souhaite recevoir les newsletters',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d''inscription du client',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- Table `cart` (Panier)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `product_id` int unsigned NOT NULL COMMENT 'Identifiant du produit dans le panier',
  `quantity` int NOT NULL DEFAULT '1' COMMENT 'Quantité du produit',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d''ajout au panier',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-----------------------------------------------------
-- Table structure for table `utilisateurs`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `utilisateurs`;

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `newsletter` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
-- -----------------------------------------------------
-- Data pour la table `category`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `category` (`name`, `subtitle`, `picture`, `home_order`, `created_at`) 
VALUES 
  ('CD', 'Disques compacts', 'assets/images/cd.jpg', 1, NOW()),
  ('DVD', 'Films en DVD', 'assets/images/dvd.jpg', 2, NOW()),
  ('Accessoires', 'Accessoires divers', 'assets/images/accessoires.jpg', 3, NOW());
COMMIT;

-- -----------------------------------------------------
-- Data pour la table `product`
-- -----------------------------------------------------
START TRANSACTION;

-- Insertion des CDs
INSERT INTO product (id, nom, artiste, prix, description, image) VALUES
(1, 'Bad', 'Michael Jackson', 15.00, 'L\'album légendaire de Michael Jackson, avec des hits incontournables comme "Smooth Criminal", "Man in the Mirror", et "Bad".', '/image/cd_1.jpg'),
(2, 'Illmatic', 'Nas', 14.00, 'Un album incontournable, considéré comme l\'un des meilleurs albums de rap de tous les temps, avec des paroles percutantes et un flow unique.', '/image/cd_2.jpg'),
(3, 'Starboy', 'The Weeknd', 13.50, 'Un album novateur de The Weeknd, fusionnant R&B, pop et électronique, avec des hits comme "Starboy" et "I Feel It Coming".', '/image/cd_3.jpg'),
(4, 'Ready to Die', 'The Notorious B.I.G.', 14.50, 'Le premier album de Biggie Smalls, un mélange d\'histoires personnelles et de morceaux emblématiques du rap East Coast.', '/image/cd_4.jpg'),
(5, 'The Miseducation of Lauryn Hill', 'Lauryn Hill', 16.00, 'Un album emblématique mélangeant soul, R&B et rap, avec des morceaux intemporels comme "Doo Wop (That Thing)" et "Ex-Factor".', '/image/cd_5.jpg');

-- Insertion des DVDs
INSERT INTO product (id, nom, prix, description, image) VALUES
(6, 'Sister Act 2', 10.50, 'Une comédie musicale touchante où Whoopi Goldberg aide une chorale d\'école à retrouver sa passion pour la musique.', '/image/dvd_1.jpg'),
(7, 'Straight Outta Compton', 12.00, 'Un film biographique racontant l\'ascension du groupe légendaire de rap N.W.A et leur impact culturel.', '/image/dvd_2.jpg'),
(8, '8 Mile', 9.00, 'Le parcours inspirant d\'un jeune rappeur, incarné par Eminem, qui cherche à faire ses preuves dans le monde du rap.', '/image/dvd_3.jpg'),
(9, 'The Greatest Showman', 10.00, 'Un film musical spectaculaire avec Hugh Jackman, retraçant l\'histoire de P.T. Barnum et la création du cirque moderne.', '/image/dvd_4.jpg'),
(10, 'Bohemian Rhapsody', 13.00, 'Un biopic émouvant sur Freddie Mercury et le groupe Queen, célébrant leur musique et leur impact culturel.', '/image/dvd_5.jpg');

-- Insertion des accessoires
INSERT INTO product (id, nom, prix, description, image) VALUES
(11, 'Casque Audio - Sony', 25.00, 'Découvrez une qualité audio exceptionnelle avec ce casque Sony. Il est idéal pour écouter de la musique et son design ergonomique garantit un confort optimal.', '/image/accessoire_1.jpg'),
(12, 'Chargeur Universel - Samsung', 15.50, 'Ce chargeur universel rapide de Samsung est parfait pour recharger vos appareils en un temps record. Compatible avec la plupart des smartphones et tablettes.', '/image/accessoire_2.jpg'),
(13, 'Support de Téléphone - Apple', 10.00, 'Maintenez votre téléphone en toute sécurité grâce à ce support robuste et élégant signé Apple. Il est parfait pour regarder des vidéos ou utiliser votre GPS.', '/image/accessoire_3.jpg'),
(14, 'Enceinte Bluetooth - JBL', 35.00, 'Appréciez un son de qualité supérieure avec cette enceinte Bluetooth portable JBL. Parfaite pour les fêtes ou les moments de détente.', '/image/accessoire_4.jpg'),
(15, 'Sac à Dos - Nike', 40.00, 'Un sac à dos pratique et stylé de Nike, parfait pour vos activités sportives ou pour une utilisation quotidienne.', '/image/accessoire_5.jpg');

COMMIT;

-- -----------------------------------------------------
-- Réactivation des contraintes de clé étrangère
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS=1;
SET UNIQUE_CHECKS=1;
