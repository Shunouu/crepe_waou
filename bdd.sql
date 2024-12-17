-- MySQL Script généré par MySQL Workbench
-- 12/12/24 15:00:00

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Table `home`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `home`;

CREATE TABLE IF NOT EXISTS `home` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL COMMENT 'Nom de la section sur la page d\'accueil',
  `description` TEXT NULL COMMENT 'Description de la section',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création de la section',
  `updated_at` TIMESTAMP NULL COMMENT 'Date de la dernière mise à jour de la section',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `category`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE IF NOT EXISTS `category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL COMMENT 'Nom de la catégorie',
  `subtitle` VARCHAR(64) NULL COMMENT 'Sous-titre de la catégorie',
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

CREATE TABLE IF NOT EXISTS `product` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL COMMENT 'Nom du produit',
  `description` TEXT NULL COMMENT 'Description du produit',
  `picture` VARCHAR(128) NULL COMMENT 'URL de l\'image du produit',
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Prix du produit',
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Statut du produit (1=disponible, 2=non disponible)',
  `updated_at` TIMESTAMP NULL COMMENT 'Date de la dernière mise à jour du produit',
  `category_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `category`(`id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table de connexion (login)
-- -----------------------------------------------------

DROP TABLE IF EXISTS `login`;

CREATE TABLE IF NOT EXISTS `login` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(128) NOT NULL COMMENT 'Email de l\'utilisateur',
  `password` VARCHAR(255) NOT NULL COMMENT 'Mot de passe crypté',
  `role` ENUM('admin', 'user') NOT NULL COMMENT 'Rôle de l\'utilisateur (admin ou utilisateur)',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création du compte',
  `updated_at` TIMESTAMP NULL COMMENT 'Date de la dernière mise à jour du compte',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `product`
-- -----------------------------------------------------


CREATE TABLE `formulaire` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(64) NOT NULL COMMENT 'Nom du client',
  `email` VARCHAR(128) NOT NULL COMMENT 'Email du client',
  `password` VARCHAR(255) NOT NULL COMMENT 'Mot de passe du client',
  `adresse` VARCHAR(255) NOT NULL COMMENT 'Adresse du client',
  `ville` VARCHAR(128) NOT NULL COMMENT 'Ville du client',
  `code_postal` VARCHAR(20) NOT NULL COMMENT 'Code postal du client',
  `newsletter` BOOLEAN DEFAULT FALSE COMMENT 'Souhaite recevoir les newsletters',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d\'inscription du client',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `cart` (Panier)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cart`;

CREATE TABLE IF NOT EXISTS `cart` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL COMMENT 'Identifiant de l\'utilisateur',
  `product_id` INT UNSIGNED NOT NULL COMMENT 'Identifiant du produit dans le panier',
  `quantity` INT NOT NULL DEFAULT 1 COMMENT 'Quantité du produit',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d\'ajout au panier',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `login`(`id`),
  FOREIGN KEY (`product_id`) REFERENCES `product`(`id`)
) ENGINE = InnoDB;

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
INSERT INTO product (nom, artiste, prix, description, image) VALUES
('Bad', 'Michael Jackson', 15.00, 'L\'album légendaire de Michael Jackson, avec des hits incontournables comme "Smooth Criminal", "Man in the Mirror", et "Bad".', '/image/cd_1.jpg'),
('Illmatic', 'Nas', 14.00, 'Un album incontournable, considéré comme l\'un des meilleurs albums de rap de tous les temps, avec des paroles percutantes et un flow unique.', '/image/cd_2.jpg'),
('Starboy', 'The Weeknd', 13.50, 'Un album novateur de The Weeknd, fusionnant R&B, pop et électronique, avec des hits comme "Starboy" et "I Feel It Coming".', '/image/cd_3.jpg'),
('Ready to Die', 'The Notorious B.I.G.', 14.50, 'Le premier album de Biggie Smalls, un mélange d\'histoires personnelles et de morceaux emblématiques du rap East Coast.', '/image/cd_4.jpg'),
('The Miseducation of Lauryn Hill', 'Lauryn Hill', 16.00, 'Un album emblématique mélangeant soul, R&B et rap, avec des morceaux intemporels comme "Doo Wop (That Thing)" et "Ex-Factor".', '/image/cd_5.jpg');

-- Insertion des DVDs
INSERT INTO product (nom, prix, description, image) VALUES
('Sister Act 2', 10.50, 'Une comédie musicale touchante où Whoopi Goldberg aide une chorale d\'école à retrouver sa passion pour la musique.', '/image/dvd_1.jpg'),
('Straight Outta Compton', 12.00, 'Un film biographique racontant l\'ascension du groupe légendaire de rap N.W.A et leur impact culturel.', '/image/dvd_2.jpg'),
('8 Mile', 9.00, 'Le parcours inspirant d\'un jeune rappeur, incarné par Eminem, qui cherche à faire ses preuves dans le monde du rap.', '/image/dvd_3.jpg'),
('The Greatest Showman', 10.00, 'Un film musical spectaculaire avec Hugh Jackman, retraçant l\'histoire de P.T. Barnum et la création du cirque moderne.', '/image/dvd_4.jpg'),
('Bohemian Rhapsody', 13.00, 'Un biopic émouvant sur Freddie Mercury et le groupe Queen, célébrant leur musique et leur impact culturel.', '/image/dvd_5.jpg');

-- Insertion des accessoires
INSERT INTO product (nom, prix, description, image) VALUES
('Casque Audio - Sony', 25.00, 'Découvrez une qualité audio exceptionnelle avec ce casque Sony. Il est idéal pour écouter de la musique et son design ergonomique garantit un confort optimal.', '/image/accessoire_1.jpg'),
('Chargeur Universel - Samsung', 15.50, 'Ce chargeur universel rapide de Samsung est parfait pour recharger vos appareils en un temps record. Compatible avec la plupart des smartphones et tablettes.', '/image/accessoire_2.jpg'),
('Support de Téléphone - Apple', 10.00, 'Maintenez votre téléphone en toute sécurité grâce à ce support robuste et élégant signé Apple. Il est parfait pour regarder des vidéos ou utiliser votre GPS.', '/image/accessoire_3.jpg'),
('Enceinte Bluetooth - JBL', 35.00, 'Profitez d\'un son puissant et clair avec cette enceinte Bluetooth portable JBL. Idéale pour écouter de la musique en extérieur, elle offre une autonomie prolongée.', '/image/accessoire_4.jpg'),
('Adaptateur HDMI - Belkin', 12.50, 'Connectez facilement vos appareils grâce à cet adaptateur HDMI de Belkin. Compatible avec les téléviseurs et les consoles de jeux.', '/image/accessoire_5.jpg');
COMMIT;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;