-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 jan. 2026 à 08:26
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
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `realisateur` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `synopsis` text,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_realisateur` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_films_realisateur` (`id_realisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `realisateur`, `genre`, `duree`, `synopsis`, `image`, `user_id`, `created_at`, `id_realisateur`) VALUES
(1, 'F1', 'Joseph Kosinski', 'drame sportif', 155, 'Sonny Hayes était le prodige de la F1 des années 90 jusqu’à son terrible accident. Trente ans plus tard, devenu un pilote indépendant, il est contacté par Ruben Cervantes, patron d’une écurie en faillite qui le convainc de revenir pour sauver l’équipe et prouver qu’il est toujours le meilleur. Aux côtés de Joshua Pearce, diamant brut prêt à devenir le numéro 1, Sonny réalise vite qu\'en F1, son coéquipier est aussi son plus grand rival, que le danger est partout et qu\'il risque de tout perdre.', '695cd59349731.jpg', 5, '2026-01-06 10:27:47', 1),
(2, 'Need For Speed', 'Scoot Waugh', 'Action', 130, 'Tobey Marshall et Dino Brewster partagent la passion des bolides et des courses, mais pas de la même façon… Parce qu’il a fait confiance à Dino, Tobey s’est retrouvé derrière les barreaux. Lorsqu’il sort enfin, il ne rêve que de vengeance. La course des courses, la De Leon – légendaire épreuve automobile clandestine – va lui en donner l’occasion. Mais pour courir, Tobey va devoir échapper aux flics qui lui collent aux roues, tout en évitant le chasseur de primes que Dino a lancé à ses trousses. Pas question de freiner…', '695cdbabdb4e3.jpg', 5, '2026-01-06 10:53:47', 2),
(3, 'Bleach', 'Shinsuke Satō', 'Action Fantasy', 108, 'Ichigo Kurosaki, 15 ans, arrive à voir des spectres depuis sa plus tendre enfance. Un soir, sa routine quotidienne est bouleversée suite à sa rencontre avec une shinigami : Rukia Kuchiki, et la venue d\'un monstre appelé hollow. Ce dernier étant venu dévorer les âmes de sa famille et la shinigami venue le pr', '695cdc5bc2abd.jpg', 5, '2026-01-06 10:56:43', 3),
(6, 'Le seigneur des anneaux: le deux tours', 'Peter Jackson', 'Aventure fantastique', 179, '', '695d34625900e.jpg', 5, '2026-01-06 17:12:18', 4);

-- --------------------------------------------------------

--
-- Structure de la table `films_genres`
--

DROP TABLE IF EXISTS `films_genres`;
CREATE TABLE IF NOT EXISTS `films_genres` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `films_genres`
--

INSERT INTO `films_genres` (`id_film`, `id_genre`) VALUES
(1, 1),
(2, 2),
(3, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_genre` (`nom_genre`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `nom_genre`) VALUES
(1, 'drame sportif'),
(2, 'Action'),
(3, 'Action Fantasy'),
(4, 'Aventure fantastique'),
(5, 'Comédie'),
(6, 'Drame'),
(7, 'Science-Fiction'),
(8, 'Thriller'),
(9, 'Horreur'),
(10, 'Romance'),
(11, 'Animation');

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

DROP TABLE IF EXISTS `realisateur`;
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `realisateur`
--

INSERT INTO `realisateur` (`id`, `nom`, `prenom`) VALUES
(1, 'Kosinski', 'Joseph'),
(2, 'Waugh', 'Scoot'),
(3, 'Satō', 'Shinsuke'),
(4, 'Jackson', 'Peter');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'Dupont', 'Jean', 'jean@demo.fr', ''),
(2, 'Martin', 'Claire', 'claire@demo.fr', ''),
(5, 'patate', 'frite', 'frite.patate@gmail.com', '$2y$10$UGphwg/pWWD9KnIxSSFGnuYqy4srxniLlsMFF368ZV329s3bFWu3a'),
(6, 'jean', 'edouard', 'jean.edouard@gmail.com', '$2y$10$jpnsH79kSdBaPj8Z32s70OaeI27FOjhBC2q5vyybntb9AJQnaE/6W');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
