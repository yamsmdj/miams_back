-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 mai 2024 à 16:59
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
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, 5, 7, 'Déguster'),
(8, 1, 1, 'Faites dorer le pain, coupé en cubes, 3 min dans un peu d\'huile. '),
(9, 1, 2, 'Déchirez les feuilles de romaine dans un saladier, et ajoutez les croûtons préalablement épongés dans du papier absorbant.'),
(10, 1, 3, 'Préparez la sauce : Faites cuire l\'oeuf 1 min 30 dans l\'eau bouillante, et rafraîchissez-le.'),
(11, 1, 4, 'Cassez-le dans le bol d\'un mixeur et mixez, avec tous les autres ingrédients; rectifiez l\'assaissonnement et incorporez à la salade. '),
(12, 1, 5, 'Décorez de copeaux de parmesan, et servez.'),
(13, 3, 1, 'Préchauffer le four à 180°C (thermostat 6). Etaler la pâte dans un moule'),
(14, 3, 2, 'la piquer à la fourchette. Parsemer de copeaux de beurre.'),
(15, 3, 3, 'Faire rissoler les lardons à la poêle puis les éponger avec une feuille d\'essuie-tout.'),
(16, 3, 4, 'Battre les oeufs, la crème fraîche et le lait.'),
(17, 3, 5, 'Cuire 45 à 50 min.'),
(18, 3, 6, 'Déguster'),
(19, 6, 1, 'Préchauffer le four à 180°C (thermostat 6). Faire fondre le chocolat et le beurre au bain-marie à feu doux, ou au micro-ondes sur le programme décongélation'),
(20, 6, 2, 'Pendant ce temps, séparer les jaunes des blancs d\'oeuf.'),
(21, 6, 3, 'Quand le mélange chocolat-beurre est bien fondu, ajouter les jaunes d’oeufs et fouetter. '),
(22, 6, 4, 'Incorporer le sucre et la farine, puis ajouter les blancs d’oeufs sans les casser.'),
(23, 6, 5, 'Beurrer et fariner un moule à manqué et y verser la pâte à gâteau.'),
(24, 6, 6, 'Quand le gâteau est cuit, le laisser refroidir avant de le démouler'),
(25, 7, 1, 'Faire blanchir les champignons dans 1/2 litre d\'eau salée pendant 5 minutes. Égouttez-les et conservez leur bouillon.'),
(26, 7, 2, 'Dans un poêlon ou une grande casserole à fond peu épais, faire revenir l\'oignon, l\'ail et le persil hachés fin dans 2 cuillères à soupe de crème fraiche.'),
(27, 7, 3, 'Rajoutez le riz, les champignons, le reste de la crème et le mascarpone et recouvrez du bouillon. Assaisonnez. Laissez cuire à couvert à feu moyen jusqu\'à ce que le riz soit fondant et la sauce crémeuse (au moins 45 minutes).'),
(28, 7, 4, 'Hors du feu, incorporez le parmesan râpé. Remuez bien.'),
(29, 7, 5, 'Servez bien chaud.'),
(30, 7, 6, 'A servir avec des langoustines par exemple.'),
(31, 10, 1, 'Faire blanchir les champignons dans 1/2 litre d\'eau salée pendant 5 minutes. Égouttez-les et conservez leur bouillon.'),
(32, 10, 2, 'Mettez les blancs et le sel dans un saladier.'),
(33, 10, 3, 'Fouettez de plus en plus vite.'),
(34, 10, 4, 'Incorporez le vinaigre et la maïzena tamisée.'),
(35, 10, 5, 'Formez aussitôt des tas sur une plaque anti-adhésive.'),
(36, 10, 6, 'Enfournez pour 1 heure de cuisson. Les meringues doivent être blond très clair, sèches dessus et dessous. '),
(37, 10, 7, 'Laissez refroidir puis décollez-les du papier cuisson.'),
(60, 36, 1, 'acheter l\'eau'),
(61, 36, 2, 'ouvrir la bouteille'),
(62, 36, 3, 'verser dans un verre'),
(63, 36, 4, 'Deguster'),
(102, 36, 1, 'acheter l\'eau'),
(103, 36, 2, 'ouvrir la bouteille'),
(104, 36, 3, 'verser dans un verre'),
(105, 36, 4, 'Deguster');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `title`, `description`, `time`, `created_at`, `categorie_id`, `picture`) VALUES
(1, 'Salade Cesar', 'Tres bonne pour l\'été fraiche et appetissante', 20, '2024-05-03 16:35:16', 1, 'recettes66478c2372fd9.png'),
(3, 'La quiche lorraine', 'Maintenant que vous maîtrisez la pâte brisée, je vous montre comment la garnir façon Lorraine avec du lard fumé et beaucoup de gruyère bien sûr !! Prêts à vous régaler ?!\n', 30, '2024-04-20 18:15:29', 1, 'laquichelorraine.png'),
(5, 'Lasagnes à la bolognaise', ' la bolognaise est parfaite pour découvrir les légumineuses. Enrobées de sauce tomate, les lentilles se transforment en une sauce fondante et végétarienne ! »', 125, '2024-04-24 21:42:39', 2, 'lasagnesalabolognaise.png'),
(6, 'fondant au chocolat', '« Pour aller plus vite, pour faire fondre le chocolat et le beurre, je mets le tout dans un bol coupé en carrés au micro-ondes.', 40, '2024-04-24 21:47:29', 3, 'fondant_au_chocolat.png'),
(7, 'Risotto aux champignons', 'Tres bonne pour l\'été fraiche et appetissante', 50, '2024-04-28 13:25:56', 2, 'risottoauxchampignons.png'),
(10, 'Meringue', 'Cette recette est un miracle !', 10, '2024-04-28 13:51:44', 3, 'meringue.png'),
(12, 'Oeufs mollets', 'La cuisson des oeufs ne s\'improvise pas. Attention donc à cuire des oeufs qui sont à température ambiante. Donc si vous avez l\'habitude de les conserver au réfrigérateur, sortez-les 1 heure avant. Ainsi, vous éviterez les chocs thermiques et le risque que', 8, '2024-05-06 23:34:47', 1, 'oeufsmollets.png'),
(36, 'Eau', 'je bois de l\'eau ', 0, '2024-05-08 13:43:02', 1, 'eau.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '$2y$13$bPa02wo6OG1V.hMWRdU0gOaHlo8wFssFvrRPgsRpDZesrlFliVkZ2'),
(2, 'admin@admin.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$hn0Q3Y.j4DkwwOR7P89rAeF1SqYAsFi3u/0HcoHZcuNNRVln26zQC'),
(3, 'user@user.com', '[\"ROLE_USER\"]', '$2y$13$oA1TAQFgcb9qqndW5s0MtOkbAIFg0bS/W7RwDQEH6EwSKj.mHB9yq'),
(4, 'yams@yams.fr', '[\"ROLE_ADMIN\"]', '$2y$13$RGj6.963tUbpYOIbd9yS6etsum3eKAUXbtdArk4NaLKMhtHgWW752'),
(6, 'test@test.com', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '$2y$13$tTIbcuJSDoMo2lFttUzBQug8OKCOS3F4WTLHh5d5supOXK3/ZBVzu');

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
