-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 mai 2024 à 21:45
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miams`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'Entrée'),
(2, 'Plats'),
(3, 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240420183909', '2024-05-06 21:11:22', 14),
('DoctrineMigrations\\Version20240506211102', '2024-05-06 21:11:36', 61);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `id` int NOT NULL AUTO_INCREMENT,
  `recette_id` int DEFAULT NULL,
  `n_etape` int NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_285F75DD89312FE9` (`recette_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`id`, `recette_id`, `n_etape`, `description`) VALUES
(1, 5, 1, 'Faire revenir gousses hachées d\'ail et les oignons émincés dans un peu d\'huile d\'olive.'),
(2, 5, 2, 'Ajouter la carotte et la branche de céleri hachée puis la viande et faire revenir le tout.'),
(3, 5, 3, 'Au bout de quelques minutes, ajouter le vin rouge. Laisser cuire jusqu\'à évaporation.'),
(4, 5, 4, 'Ajouter la purée de tomates, l\'eau et les herbes. Saler, poivrer, puis laisser mijoter à feu doux 45 minutes.'),
(5, 5, 5, 'Préparer la béchamel : faire fondre 100 g de beurre.'),
(6, 5, 6, 'Remettre sur le feu et remuer avec un fouet jusqu\'à l\'obtention d\'un mélange bien lisse. '),
(7, 5, 7, 'Déguster');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`) VALUES
(1, 'amandes'),
(2, 'ananas'),
(3, 'asperge'),
(4, 'avocat'),
(5, 'avoine'),
(6, 'betterave'),
(7, 'carotte'),
(8, 'celeri-rave'),
(9, 'chou vert'),
(10, 'endive'),
(11, 'epinards'),
(12, 'poireau'),
(13, 'poire'),
(14, 'radis'),
(15, 'oeuf'),
(16, 'poivre'),
(17, 'sel'),
(18, 'citron'),
(19, 'huile'),
(20, 'moutarde'),
(21, 'pain écroûtées'),
(22, 'muscade'),
(23, 'creme fraiche'),
(24, 'beurre'),
(25, 'lait'),
(26, 'lasagnes'),
(27, 'eau'),
(28, 'farine'),
(29, 'fromage rape'),
(30, 'sucre en poudre'),
(31, 'chocolat'),
(35, 'sucre semoule'),
(36, 'blanc d\'oeuf');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `categorie_id` int DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_49BB6390BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `title`, `description`, `time`, `created_at`, `categorie_id`, `picture`) VALUES
(1, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-04-20 17:25:56', 1, NULL),
(3, 'La quiche lorraine', 'Maintenant que vous maîtrisez la pâte brisée, je vous montre comment la garnir façon Lorraine avec du lard fumé et beaucoup de gruyère bien sûr !! Prêts à vous régaler ?!\n', 30, '2024-04-20 18:15:29', 1, NULL),
(5, 'Lasagnes à la bolognaise', ' la bolognaise est parfaite pour découvrir les légumineuses. Enrobées de sauce tomate, les lentilles se transforment en une sauce fondante et végétarienne ! »', 125, '2024-04-24 21:42:39', 2, NULL),
(6, 'fondant au chocolat', '« Pour aller plus vite, pour faire fondre le chocolat et le beurre, je mets le tout dans un bol coupé en carrés au micro-ondes.', 40, '2024-04-24 21:47:29', 3, NULL),
(7, 'Risotto aux champignons', 'Tres bonne pour l\'été fraiche et appetissante', 50, '2024-04-28 13:25:56', 2, NULL),
(10, 'Meringue', 'Cette recette est un miracle !', 10, '2024-04-28 13:51:44', 3, NULL),
(12, 'bouchra', 'test', 20, '2024-05-02 23:02:23', 1, NULL),
(13, 'test', 'test', 20, '2024-05-03 09:24:03', NULL, NULL),
(14, 'test2', 'test', 20, '2024-05-03 09:24:49', NULL, NULL),
(15, 'lej', 'test', 20, '2024-05-03 11:08:17', NULL, NULL),
(16, 'lej', 'test', 20, '2024-05-03 12:58:20', NULL, NULL),
(17, 'lej', 'test', 20, '2024-05-03 12:58:32', NULL, NULL),
(18, 'lej', 'test', 20, '2024-05-03 12:58:40', NULL, NULL),
(19, 'lej', 'test', 20, '2024-05-03 12:59:33', NULL, NULL),
(20, 'lej', 'test', 20, '2024-05-03 13:00:08', 2, NULL),
(21, 'moha', 'test', 20, '2024-05-03 13:34:24', 2, NULL),
(22, 'gg', 'oktest', 5, '2024-05-03 13:35:33', NULL, NULL),
(23, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-05-03 16:33:33', NULL, NULL),
(24, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-05-03 16:33:49', NULL, NULL),
(25, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-05-03 16:35:16', NULL, NULL),
(26, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-05-03 16:35:39', NULL, NULL),
(27, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-05-03 16:35:43', NULL, NULL),
(53, 'rea', 'rea', 23, '2024-05-05 16:20:54', NULL, NULL),
(54, 'dz', 'dz', -1, '2024-05-05 16:25:00', NULL, NULL),
(55, 'dz', 'dz', 23, '2024-05-05 16:27:07', NULL, NULL),
(56, 'dz', 'dz', 23, '2024-05-05 16:27:29', NULL, NULL),
(57, 'dsdsds', 'dsdsd', 23, '2024-05-05 16:38:57', NULL, NULL),
(58, 'wwww', 'wwww', 2, '2024-05-05 16:45:59', NULL, NULL),
(59, 'wwwww', 'wwwwwww', 32, '2024-05-05 16:50:29', 2, NULL),
(60, 'wwwww', 'wwwwwww', 32, '2024-05-05 16:50:46', 2, NULL),
(61, 'wwwww', 'wwwwwww', 32, '2024-05-05 16:50:52', 3, NULL),
(62, 'vwzdvwd', 'wwwwwww', 32, '2024-05-05 16:51:53', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingredient`
--

DROP TABLE IF EXISTS `recette_ingredient`;
CREATE TABLE IF NOT EXISTS `recette_ingredient` (
  `recette_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  PRIMARY KEY (`recette_id`,`ingredient_id`),
  KEY `IDX_17C041A989312FE9` (`recette_id`),
  KEY `IDX_17C041A9933FE08C` (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette_ingredient`
--

INSERT INTO `recette_ingredient` (`recette_id`, `ingredient_id`) VALUES
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(3, 15),
(3, 16),
(3, 17),
(3, 22),
(3, 23),
(3, 24),
(3, 25),
(5, 7),
(5, 16),
(5, 17),
(5, 22),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(6, 15),
(6, 24),
(6, 28),
(6, 30),
(6, 31),
(10, 35),
(10, 36);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '$2y$13$2HFiA2QnPdkaZeDf1zXR2O09aG7oPjhIQGSc93FgTsmc3qVViYK8y'),
(2, 'admin@admin.fr', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '$2y$13$x3IamkG.2lnnMX9r9nByMe8PjBATJxJuVAijSeDptnuL11yzxviA.'),
(3, 'user@user.com', '[\"ROLE_USER\"]', '$2y$13$eWX8NSVj3usI7mt//2hofOBfKrJYmYZJyYXmqUCf.E/pR2EUE.9gu'),
(4, 'yams@yams.fr', '[\"ROLE_ADMIN\"]', 'yams');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `FK_285F75DD89312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB6390BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `recette_ingredient`
--
ALTER TABLE `recette_ingredient`
  ADD CONSTRAINT `FK_17C041A989312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_17C041A9933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
