-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 mars 2024 à 11:24
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Id` int(255) NOT NULL,
  `AdminId` varchar(100) NOT NULL COMMENT 'Admin',
  `AdminPw` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int(11) NOT NULL,
  `idUser` int(10) NOT NULL,
  `nom_produit` varchar(255) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `idUser`, `nom_produit`, `quantite`, `prix`, `date_commande`) VALUES
(1, 18, 'Cafetière automatique Deluxe', 3, 79.00, '2023-11-24 13:41:49'),
(2, 18, 'Cafetière automatique Deluxe', 3, 79.00, '2023-11-24 13:42:35'),
(3, 18, 'Ensemble de valises Voyager', 1, 189.00, '2023-11-24 13:42:35'),
(4, 18, 'Cafetière automatique Deluxe', 3, 79.00, '2023-11-24 13:42:43'),
(5, 18, 'Ensemble de valises Voyager', 1, 189.00, '2023-11-24 13:42:43'),
(6, 18, 'Cafetière automatique Deluxe', 4, 79.00, '2023-11-24 13:46:49'),
(7, 18, 'Ensemble de valises Voyager', 1, 189.00, '2023-11-24 13:46:49'),
(8, 18, 'Cafetière automatique Deluxe', 9, 79.00, '2023-11-24 13:55:13'),
(9, 18, 'Cafetière automatique Deluxe', 3, 79.00, '2023-11-24 13:55:43'),
(10, 18, 'Cafetière automatique Deluxe', 3, 79.00, '2023-11-24 14:03:03'),
(11, 19, 'Ensemble de valises Voyager', 1, 189.00, '2023-11-24 14:04:17'),
(12, 19, 'Appareil photo numérique Lumix 4K', 1, 699.00, '2023-11-24 14:08:58'),
(0, 10, 'Smartphone Galaxy S22', 1, 799.00, '2023-11-24 14:37:41'),
(0, 10, 'Laptop Ultrabook ZenBook Pro', 2, 1299.00, '2023-11-24 14:37:41'),
(0, 21, 'Test', 1, 1.00, '2024-02-13 07:06:18'),
(0, 10, 'Test', 1, 1.00, '2024-03-12 08:42:29'),
(0, 22, 'Cafetière automatique Deluxe', 1, 79.00, '2024-03-12 09:40:42'),
(0, 22, 'Test', 1, 1.00, '2024-03-12 09:47:09'),
(0, 22, 'Test', 1, 1.00, '2024-03-12 09:51:41');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `paiement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom`, `categorie`, `prix`, `description`, `image`, `stock`, `paiement`) VALUES
(3016, 'Appareil photo numérique Lumix 4K', 'Photo et Caméscopes', 699.00, 'Capturez des images incroyables avec cet appareil photo 4K de Panasonic.', 'https://image.darty.com/image_son/photo_numerique/appareil_photo/panasonic_tz90_s2304287549032A_135816126.png', 110, ''),
(3017, 'Cafetière automatique Deluxe', 'Cuisine et Maison', 79.00, 'Préparez le café parfait à chaque fois avec cette cafetière automatique haut de gamme.', 'https://www.nespresso.com/ecom/medias/sys_master/public/12715488641054/Desktop-PDP-6272x2432.jpg?impolicy=productPdpMainDefault&imwidth=1568', 70, ''),
(3018, 'Tondeuse à gazon PowerMaster', 'Jardin', 299.00, 'Une tondeuse à gazon robuste avec une puissance maximale pour un jardin impeccable.', 'https://www.nemura.fr/wp-content/uploads/2023/02/TD196A-big.jpg.webp', 95, ''),
(3019, 'Ensemble de valises Voyager', 'Bagages', 189.00, 'Un ensemble de valises élégantes et durables pour tous vos voyages.', 'https://www.mesbagages.com/images/bagages/valise-madisson-875030z.jpg', 105, ''),
(3020, 'Console de jeu Quantum X', 'Jeux vidéo', 449.00, 'Une console de jeu de nouvelle génération avec des graphismes époustouflants et une expérience immersive.', 'https://static.fnac-static.com/multimedia/Images/39/39/B3/67/424761-3-1520-3/tsp20221201151627/Microsoft-Xbox-One-Quantum-Break-Bundle-console-de-jeux-500-Go-HDD-noir.jpg', 85, ''),
(3021, 'Vélo électrique EcoRider', 'Sports et Loisirs', 899.00, 'Explorez la ville avec facilité grâce à ce vélo électrique écologique.', 'https://alerion-cycles.com/cdn/shop/products/a_black_1_720x.png?v=1682277883', 75, ''),
(3022, 'Test', 'Test', 1.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'https://us.123rf.com/450wm/koya79/koya792006/koya79200600087/149748929-police-de-n%C3%A9on-3d-rendu-3d-de-n%C3%A9on-bleu-et-rose-num%C3%A9ro-3.jpg', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Droit` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Droit`) VALUES
(1, 'root', '$2y$10$pNFO/NyNCwPtV32W.E', 0),
(2, 'test', '$2y$10$Eh0noPsYkdqjXcUgU7', 0),
(3, 'kilian', '$2y$10$Ccg508BGSe7oJab1o/', 0),
(4, 'aa', '$2y$10$36EgTQag1x714RpLqP', 0),
(5, 'bbbb', '$2y$10$eNPQgnTbfhwwChWZx.', 0),
(6, 'bonjou', '$2y$10$ZN29rLaBMwY7Hka.0X', 0),
(7, 'cpasgrave', '$2y$10$6XHUUj4nJNQHEf9JiA', 0),
(8, 'testcon', '$2y$10$81tEmj4nXDF8nTlx2y', 0),
(9, '', '$2y$10$.A.z2JR2r/XMiDDTXP', 0),
(10, 'JJ', '$2y$10$pYJY/1pY2O2czBOrhlmF4.o/opjwBvKi0m2y/s56W0xSlHmqWwgUG', 5),
(11, 'KK', '$2y$10$y/jQASb2j/yorsgrw2gq7.nqFShjDiHXBnuPOropeA7cn9FvdSK9y', 0),
(12, 'ok', '$2y$10$kcb1SUS.VLvBZHWuc5.en.aGDm.R6kddudCwaaxn7vuC.neiFm6Q2', 0),
(13, 'hello', '$2y$10$ls4EERA6JR296XCc.FXM4.7IZHF6bhtiC4FfTPYru5zLIplFhxZDW', 0),
(14, 'hi', '$2y$10$yL99kRbTBNgNE.wXPTN.J.htxro3.OoF5dNC8VPB5/jlzDTKarh96', 0),
(15, 'ki', '$2y$10$bVCaJiD8Q0Kv5ylMTrdrJe95cdceJ9QWpw/Zz7KsABJUKde8OZWN.', 0),
(16, 'Testsession', '$2y$10$M5HvHWkpmDtvZePVduaGmesKGJyCxokfMk/RDQrcy9xXW5RvHPohm', 0),
(18, 't', '$2y$10$ectVQK3Ei/GKKpNR7xo2u.e0M1NErR1T1.mvYPe0ren1zhJ9hu7/i', NULL),
(19, 'Camarche', '$2y$10$Q3Tjo/ZEeHD.JfTv5BxLaegFPa9Am0Tem314WQWsDJ0VOvK8R4lJC', NULL),
(20, 'testpaiement', '$2y$10$zW6gM1CetBV0yDZmZCb0iOgBX292MXTMmF1ChhMPRWmEZTtebXQJS', NULL),
(21, 'Test10', '$2y$10$A/XDJnl0AU.B6er7wp4aFun4clKevVwY5O82njtX6PORVUVJb2HLK', NULL),
(22, 'Nouveau', '$2y$10$o1NoEE2E30u5vmoL0gMjzOJd.wzbxyHh9ymm2SlMHSNn67es3Uo8i', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3024;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
