-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 08 avr. 2025 à 23:03
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `antic`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `Id_annonce` int NOT NULL AUTO_INCREMENT,
  `Titre_annonce` varchar(255) NOT NULL,
  `Document_annonce` varchar(255) DEFAULT NULL,
  `Description_annonce` text,
  `Date_annonce` date DEFAULT NULL,
  PRIMARY KEY (`Id_annonce`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`Id_annonce`, `Titre_annonce`, `Document_annonce`, `Description_annonce`, `Date_annonce`) VALUES
(3, 'Avis candidature', 'uploads/link.txt', 'Recrutement Express', '2024-08-20');

-- --------------------------------------------------------

--
-- Structure de la table `cellule`
--

DROP TABLE IF EXISTS `cellule`;
CREATE TABLE IF NOT EXISTS `cellule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `departement_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_id` (`departement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `courriers`
--

DROP TABLE IF EXISTS `courriers`;
CREATE TABLE IF NOT EXISTS `courriers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `courriers`
--

INSERT INTO `courriers` (`id`, `sender_id`, `recipient_email`, `subject`, `message`, `sent_at`) VALUES
(1, 7, 'dg@gmail.com', 'eco-test', 'Salut', '2024-08-27 12:27:31');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `direction_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direction_id` (`direction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `digital_seals`
--

DROP TABLE IF EXISTS `digital_seals`;
CREATE TABLE IF NOT EXISTS `digital_seals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `file_transfer_id` int NOT NULL,
  `seal` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `file_transfer_id` (`file_transfer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `digital_signatures`
--

DROP TABLE IF EXISTS `digital_signatures`;
CREATE TABLE IF NOT EXISTS `digital_signatures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `file_transfer_id` int NOT NULL,
  `signature` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `file_transfer_id` (`file_transfer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `digital_signatures`
--

INSERT INTO `digital_signatures` (`id`, `user_id`, `file_transfer_id`, `signature`, `created_at`) VALUES
(8, 7, 24, 'testsign', '2024-08-26 12:18:19'),
(7, 7, 24, 'bbbetr', '2024-08-26 12:13:21'),
(6, 7, 24, 'hgfjfh', '2024-08-26 12:13:03');

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

DROP TABLE IF EXISTS `direction`;
CREATE TABLE IF NOT EXISTS `direction` (
  `direction_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `structure_id` int DEFAULT NULL,
  PRIMARY KEY (`direction_id`),
  KEY `structure_id` (`structure_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `file_transfers`
--

DROP TABLE IF EXISTS `file_transfers`;
CREATE TABLE IF NOT EXISTS `file_transfers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int DEFAULT NULL,
  `recipient_id` int DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `priorite` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `recipient_id` (`recipient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `file_transfers`
--

INSERT INTO `file_transfers` (`id`, `sender_id`, `recipient_id`, `file_name`, `file_path`, `subject`, `categorie`, `type`, `priorite`, `created_at`) VALUES
(27, 7, 9, 'Doc1.pdf', 'uploads/Doc1.pdf', 'eco-test25', '', 'Courrier Entrant', 'Normal', '2024-08-28 12:39:17'),
(26, 9, 7, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'eco-test1', '', 'Courrier Entrant', 'Urgent', '2024-08-26 20:10:09'),
(25, 7, 9, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'demande de stage', '', 'courier entrant', 'Très Urgent', '2024-08-26 16:48:28'),
(24, 9, 7, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'eco-test', '', 'Courrier Entrant', 'Très Urgent', '2024-08-26 13:12:39'),
(28, 7, 9, 'Doc1.pdf', 'uploads/Doc1.pdf', 'eco-test25', 'Courrier Entrant', 'Courrier Entrant', 'Normal', '2024-08-29 11:44:02'),
(29, 12, 7, 'Doc1.pdf', 'uploads/Doc1.pdf', 'eco-test25', 'Courrier Sortant', 'Courrier Entrant', 'Urgent', '2024-08-29 12:00:27'),
(30, 13, 14, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'venant du directeur general', 'Courrier Interne', 'Courrier Entrant', 'Normal', '2024-09-15 20:05:07'),
(31, 14, 8, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'venant du directeur', 'Courrier Interne', 'Courrier Entrant', 'Urgent', '2024-09-15 20:29:29'),
(32, 8, 15, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'venant du sous directeur', 'Courrier Entrant', 'Courrier Entrant', 'Très Urgent', '2024-09-15 20:31:10'),
(33, 15, 12, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'venant du chef service', 'Courrier Interne', 'Courrier Entrant', 'Normal', '2024-09-15 20:32:56'),
(34, 12, 8, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'initiateur', 'Courrier Sortant', 'init', 'Urgent', '2024-09-16 10:39:04'),
(35, 12, 13, 'PROPOSITION D.docx', 'uploads/PROPOSITION D.docx', 'initiateur', 'Courrier Sortant', 'init', 'Urgent', '2024-09-16 10:39:04');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `message` text,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 7, 'Vous avez reçu un nouveau fichier : react.txt', 0, '2024-08-20 13:36:33'),
(2, 8, 'Vous avez reçu un nouveau fichier : react.txt', 0, '2024-08-20 14:46:57'),
(3, 7, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-20 16:09:28'),
(4, 10, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-23 12:25:33'),
(5, 10, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-23 12:33:59'),
(6, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:20:01'),
(7, 10, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:20:01'),
(8, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:40:48'),
(9, 10, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:40:48'),
(10, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:42:19'),
(11, 10, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:42:19'),
(12, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:49:14'),
(13, 10, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 17:49:14'),
(14, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 18:07:40'),
(15, 10, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 18:07:40'),
(16, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 19:05:27'),
(17, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 20:09:45'),
(18, 7, 'Vous avez reçu un nouveau fichier : eco-test25', 0, '2024-08-25 20:19:11'),
(19, 7, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 12:47:58'),
(20, NULL, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 13:01:44'),
(21, 10, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 13:08:47'),
(22, 7, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 13:09:56'),
(23, 10, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 13:09:56'),
(24, 7, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 13:12:39'),
(25, 9, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 16:48:28'),
(26, 7, 'Vous avez reçu un nouveau fichier : PROPOSITION D.docx', 0, '2024-08-26 20:10:09'),
(27, 9, 'Vous avez reçu un nouveau fichier : Doc1.pdf', 0, '2024-08-28 12:39:17');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cellule_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cellule_id` (`cellule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE IF NOT EXISTS `structure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `hierarchy_level` varchar(50) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parent` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `structure`
--

INSERT INTO `structure` (`id`, `name`, `hierarchy_level`, `parent_id`) VALUES
(1, 'DSI', 'Direction', NULL),
(3, 'Informatique', 'Département', 1),
(4, 'Reseaux', 'Cellule', 3),
(5, 'Sécurité', 'Service', 4),
(7, 'IA', 'Cellule', 3),
(8, 'finance', 'Service', 7);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `role` enum('admin','directeur-general','directeur','sous-directeur','chef-service','initiateur') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `service_id` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `service_id` (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `username`, `name`, `Email`, `Mdp`, `role`, `created_at`, `service_id`) VALUES
(1, 'admin', '', 'admin@gmail.com', '$2y$10$oeyrJoEiTg9YF62VWorgzOvWAsw0P7UGJLed/4hyFJLN.pxJjc8iq', 'admin', '2024-08-17 23:46:28', NULL),
(8, 'adam1', '', 'adam1@gmail.com', '$2y$10$OtoYwq8G2yAKGlDSe4xISuqtKzDgn6NRB.hY06MEyIKJpDkjWHs6W', 'sous-directeur', '2024-08-20 12:44:59', 5),
(13, 'Directeur ', 'General', 'directeurgeneral@gmail.com', '$2y$10$neVKhGFiAJlkaEWze4svDueLHZneiqnW.8mKDmvS.8UUvH3N0ayMa', 'directeur-general', '2024-09-15 17:57:50', 8),
(14, 'Directeur1', '1', 'directeur@gmail.com', '$2y$10$cVqbY0IqIv/QmWipN8J5AOgENfzFUQam3kCRWGr86a26amqsnXCUq', 'directeur', '2024-09-15 17:59:38', 5),
(12, 'Junior2', 'vv', 'junior@gmail.com', '$2y$10$c5u0W.VAlf6ify3apmfgz.82x.gHgG.b9eG/NtUUtmCCRZ1ZW5lSW', 'initiateur', '2024-08-29 09:59:00', 8),
(15, 'Chef', 'Service', 'chefservice@gmail.com', '$2y$10$iMeafAYtUyXX5IIcU3Mgoe9nDtGtqH9Gwr52CnHeSUy2sENrrqkeO', 'chef-service', '2024-09-15 18:00:52', 8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
