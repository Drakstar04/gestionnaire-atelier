-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 06 fév. 2026 à 09:17
-- Version du serveur : 9.1.0
-- Version de PHP : 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionnaire-atelier`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categories` int NOT NULL AUTO_INCREMENT,
  `name_categories` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categories`, `name_categories`) VALUES
(1, 'Cuisine & Gastronomie'),
(2, 'Informatique & Tech'),
(3, 'Arts & Créativité'),
(4, 'Bien-être & Sport'),
(5, 'Bricolage & Jardinage');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservations` int NOT NULL AUTO_INCREMENT,
  `date_reservations` datetime DEFAULT NULL,
  `id_workshops` int NOT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id_reservations`),
  KEY `id_workshops` (`id_workshops`),
  KEY `id_users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id_reservations`, `date_reservations`, `id_workshops`, `id_users`) VALUES
(1, '2026-02-05 16:55:25', 1, 2),
(2, '2023-01-05 10:00:00', 4, 2),
(3, '2026-02-05 16:55:25', 3, 1),
(4, '2026-02-05 16:55:25', 6, 2),
(5, '2026-02-05 16:55:25', 2, 1),
(6, '2026-02-05 16:55:25', 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_roles` int NOT NULL AUTO_INCREMENT,
  `name_roles` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_roles`, `name_roles`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `name_users` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_users` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_users` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_roles` int NOT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `email_users` (`email_users`),
  KEY `id_roles` (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `name_users`, `email_users`, `password_users`, `id_roles`) VALUES
(1, 'Administrateur', 'admin@test.com', '$2y$10$o/i2fEZx0fp5kiPdrpOyLeDg7kWJ/TSz2V.CRWmVoQPrTTMqMm8QO', 1),
(2, 'Utilisateur Test', 'user@test.com', '$2y$10$ZnJa2yoG1WETyW1Rm8AUoenVay200ZxFuVBogPvj0wvM/uOzsr4Xm', 2);

-- --------------------------------------------------------

--
-- Structure de la table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE IF NOT EXISTS `workshops` (
  `id_workshops` int NOT NULL AUTO_INCREMENT,
  `title_workshops` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_workshops` text COLLATE utf8mb4_general_ci,
  `date_workshops` date DEFAULT NULL,
  `availability_workshops` int DEFAULT NULL,
  `id_categories` int NOT NULL,
  PRIMARY KEY (`id_workshops`),
  KEY `id_categories` (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `workshops`
--

INSERT INTO `workshops` (`id_workshops`, `title_workshops`, `description_workshops`, `date_workshops`, `availability_workshops`, `id_categories`) VALUES
(1, 'Initiation Sushis', 'Apprenez à préparer vos propres sushis et makis comme un chef ! Matériel fourni.', '2026-06-15', 10, 1),
(2, 'Python pour débutants', 'Découvrez les bases de la programmation avec Python. Idéal pour commencer.', '2026-07-20', 15, 2),
(3, 'Yoga au lever du soleil', 'Une séance relaxante pour bien démarrer la journée. Tapis non fournis.', '2026-08-05', 20, 4),
(4, 'Poterie et Céramique', 'Création d\'un vase en argile. Atelier manuel et créatif. (Atelier Passé)', '2023-01-10', 0, 3),
(5, 'Restaurer un vieux meuble', 'Techniques de ponçage et de vernissage pour donner une seconde vie à vos meubles.', '2026-09-12', 2, 5),
(6, 'Atelier Macarons', 'Les secrets pour réussir des coques lisses et une ganache parfaite. Boîte de 6 offerte.', '2026-10-02', 8, 1),
(7, 'Cybersécurité : Les bases', 'Apprenez à protéger vos données personnelles et à naviguer en sécurité sur le web.', '2026-11-15', 12, 2),
(8, 'Peinture à l\'huile', 'Initiation à la peinture sur toile. Thème : Paysages d\'automne. Matériel inclus.', '2026-09-25', 6, 3),
(9, 'Méditation Guidée', 'Apprenez à gérer votre stress grâce à des techniques de respiration simples.', '2026-08-20', 15, 4),
(10, 'Jardinage sur Balcon', 'Comment créer un potager productif dans un petit espace urbain.', '2026-05-18', 10, 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_workshops`) REFERENCES `workshops` (`id_workshops`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`);

--
-- Contraintes pour la table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categories`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
