-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 nov. 2023 à 09:20
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
(3012, 'Smartphone Galaxy S22', 'Électronique', 799.99, 'Le dernier smartphone de Samsung avec des fonctionnalités avancées.', 'https://www.backmarket.fr/cdn-cgi/image/format%3Dauto%2Cquality%3D75%2Cwidth%3D640/https://d2e6ccujb3mkqf.cloudfront.net/b12fbd31-2d50-4762-ab43-2c9b60475aa6-1_9d95cc77-8d37-47bb-a3bb-330b75274b1a.jpg', 100, ''),
(3013, 'Laptop Ultrabook ZenBook Pro', 'Informatique', 1299.99, 'Un ultrabook puissant avec un écran tactile 4K pour les professionnels.', 'https://www.rueducommerce.fr/media/produits/asus/2985258/asus-zenbook-pro-14-duo-oled-ux8402za-m31-i7-12700h-ordinate-2985258-1220734420_34420_1200x1200.jpeg', 80, 'https://buy.stripe.com/00g9D17oB5AEcBq003'),
(3014, 'Enceinte Bluetooth Ultimate Boom', 'Audio', 149.99, 'Une enceinte portable étanche avec un son exceptionnel pour vos aventures en plein air.', 'https://boulanger.scene7.com/is/image/Boulanger/5099206080287_h_f_l_0?wid=500&hei=500', 120, ''),
(3015, 'Montre connectée FitPro 2000', 'Électronique', 129.50, 'Une montre intelligente avec suivi de la condition physique, GPS intégré et écran AMOLED.', 'https://www.gabrielrivaz.com/4667-large_default/montre-connectee-fitpro-silicone-noir.jpg', 90, ''),
(3016, 'Appareil photo numérique Lumix 4K', 'Photo et Caméscopes', 699.75, 'Capturez des images incroyables avec cet appareil photo 4K de Panasonic.', 'https://image.darty.com/image_son/photo_numerique/appareil_photo/panasonic_tz90_s2304287549032A_135816126.png', 110, ''),
(3017, 'Cafetière automatique Deluxe', 'Cuisine et Maison', 79.99, 'Préparez le café parfait à chaque fois avec cette cafetière automatique haut de gamme.', 'https://www.nespresso.com/ecom/medias/sys_master/public/12715488641054/Desktop-PDP-6272x2432.jpg?impolicy=productPdpMainDefault&imwidth=1568', 70, ''),
(3018, 'Tondeuse à gazon PowerMaster', 'Jardin', 299.00, 'Une tondeuse à gazon robuste avec une puissance maximale pour un jardin impeccable.', 'https://www.nemura.fr/wp-content/uploads/2023/02/TD196A-big.jpg.webp', 95, ''),
(3019, 'Ensemble de valises Voyager', 'Bagages', 189.25, 'Un ensemble de valises élégantes et durables pour tous vos voyages.', 'https://www.mesbagages.com/images/bagages/valise-madisson-875030z.jpg', 105, ''),
(3020, 'Console de jeu Quantum X', 'Jeux vidéo', 449.99, 'Une console de jeu de nouvelle génération avec des graphismes époustouflants et une expérience immersive.', 'https://static.fnac-static.com/multimedia/Images/39/39/B3/67/424761-3-1520-3/tsp20221201151627/Microsoft-Xbox-One-Quantum-Break-Bundle-console-de-jeux-500-Go-HDD-noir.jpg', 85, ''),
(3021, 'Vélo électrique EcoRider', 'Sports et Loisirs', 899.50, 'Explorez la ville avec facilité grâce à ce vélo électrique écologique.', 'https://alerion-cycles.com/cdn/shop/products/a_black_1_720x.png?v=1682277883', 75, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'root', '$2y$10$pNFO/NyNCwPtV32W.E'),
(2, 'test', '$2y$10$Eh0noPsYkdqjXcUgU7'),
(3, 'kilian', '$2y$10$Ccg508BGSe7oJab1o/'),
(4, 'aa', '$2y$10$36EgTQag1x714RpLqP'),
(5, 'bbbb', '$2y$10$eNPQgnTbfhwwChWZx.'),
(6, 'bonjou', '$2y$10$ZN29rLaBMwY7Hka.0X'),
(7, 'cpasgrave', '$2y$10$6XHUUj4nJNQHEf9JiA'),
(8, 'testcon', '$2y$10$81tEmj4nXDF8nTlx2y'),
(9, '', '$2y$10$.A.z2JR2r/XMiDDTXP'),
(10, 'JJ', '$2y$10$pYJY/1pY2O2czBOrhlmF4.o/opjwBvKi0m2y/s56W0xSlHmqWwgUG'),
(11, 'KK', '$2y$10$y/jQASb2j/yorsgrw2gq7.nqFShjDiHXBnuPOropeA7cn9FvdSK9y'),
(12, 'ok', '$2y$10$kcb1SUS.VLvBZHWuc5.en.aGDm.R6kddudCwaaxn7vuC.neiFm6Q2'),
(13, 'hello', '$2y$10$ls4EERA6JR296XCc.FXM4.7IZHF6bhtiC4FfTPYru5zLIplFhxZDW'),
(14, 'hi', '$2y$10$yL99kRbTBNgNE.wXPTN.J.htxro3.OoF5dNC8VPB5/jlzDTKarh96'),
(15, 'ki', '$2y$10$bVCaJiD8Q0Kv5ylMTrdrJe95cdceJ9QWpw/Zz7KsABJUKde8OZWN.');

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3022;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
