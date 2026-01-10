-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 10 jan. 2026 à 19:01
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clash_of_cooks`
--

-- --------------------------------------------------------

--
-- Structure de la table `classement_fin_session`
--

DROP TABLE IF EXISTS `classement_fin_session`;
CREATE TABLE IF NOT EXISTS `classement_fin_session` (
  `fk_id_profil` int NOT NULL,
  `fk_nb_votes` int NOT NULL,
  `rang` int NOT NULL,
  PRIMARY KEY (`rang`),
  KEY `fk_id_profil` (`fk_id_profil`),
  KEY `fk_nb_votes` (`fk_nb_votes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classement_globale`
--

DROP TABLE IF EXISTS `classement_globale`;
CREATE TABLE IF NOT EXISTS `classement_globale` (
  `fk_id_profil` int NOT NULL,
  `rang_glob` int NOT NULL,
  PRIMARY KEY (`rang_glob`),
  KEY `fk_id_profil` (`fk_id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

DROP TABLE IF EXISTS `profils`;
CREATE TABLE IF NOT EXISTS `profils` (
  `mail` varchar(50) NOT NULL,
  `id_profil` int NOT NULL AUTO_INCREMENT,
  `mdp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `pp` varchar(100) NOT NULL,
  `nb_victoire` int NOT NULL,
  `recettes_faites` int NOT NULL,
  PRIMARY KEY (`id_profil`),
  KEY `recettes_faites` (`recettes_faites`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`mail`, `id_profil`, `mdp`, `pseudo`, `description`, `pp`, `nb_victoire`, `recettes_faites`) VALUES
('ansem@gmail.com', 2, '$2y$10$7AatwqRKX1N2dkKA.Ae76.rTbOwX5swjwwbjwy/k5MKCIwEQGYJpS', 'Seeker_of_darkness', '', 'pp_69629bbf498cf.png', 0, 0),
('debo@gmail.com', 3, '$2y$10$hD9.SS.ovVWwZcoQI5Ho0u8Jgyvnyc17zveLoVvzdVZCzKhIL1QaC', 'deb', '', 'pp_6962a0db0adc1.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

DROP TABLE IF EXISTS `recettes`;
CREATE TABLE IF NOT EXISTS `recettes` (
  `nom` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `img` varchar(100) NOT NULL,
  `date_post` date NOT NULL,
  `fk_pseudo` int NOT NULL,
  `id_recette` int NOT NULL AUTO_INCREMENT,
  `nb_votes` int NOT NULL,
  `fk_theme` int NOT NULL,
  PRIMARY KEY (`id_recette`),
  KEY `fk_pseudo` (`fk_pseudo`),
  KEY `fk_theme` (`fk_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`nom`, `description`, `img`, `date_post`, `fk_pseudo`, `id_recette`, `nb_votes`, `fk_theme`) VALUES
('omelette des rêves', 'Une omelette à couper le souffle ! ', 'img/food_pics/omelette_original.webp', '2026-01-10', 2, 1, 0, 1),
('omelette étoilée', 'Une omelette qui vous mettra des étoiles dans les yeux !!', 'img/food_pics/omelette_etoile.webp', '2026-01-10', 3, 2, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `nom_theme` varchar(50) NOT NULL,
  `description_theme` varchar(375) NOT NULL,
  `img_theme` varchar(100) NOT NULL,
  `id_theme` int NOT NULL AUTO_INCREMENT,
  `fk_recettes_post_pour` int NOT NULL,
  PRIMARY KEY (`id_theme`),
  KEY `fk_recettes_post_pour` (`fk_recettes_post_pour`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`nom_theme`, `description_theme`, `img_theme`, `id_theme`, `fk_recettes_post_pour`) VALUES
('Omelette', 'Une omelette moelleuse constitue un classique incontournable de la cuisine, apprécié pour sa simplicité et sa versatilité. Que vous la préfériez nature, garnie de fromage, de légumes ou de viande, l’omelette se prête à toutes les envies.', 'img/food_pics/omelette_theme.png', 1, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classement_fin_session`
--
ALTER TABLE `classement_fin_session`
  ADD CONSTRAINT `classement_fin_session_ibfk_1` FOREIGN KEY (`fk_id_profil`) REFERENCES `profils` (`id_profil`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `classement_globale`
--
ALTER TABLE `classement_globale`
  ADD CONSTRAINT `classement_globale_ibfk_1` FOREIGN KEY (`fk_id_profil`) REFERENCES `profils` (`id_profil`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`fk_theme`) REFERENCES `themes` (`id_theme`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `recettes_ibfk_2` FOREIGN KEY (`fk_pseudo`) REFERENCES `profils` (`id_profil`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
