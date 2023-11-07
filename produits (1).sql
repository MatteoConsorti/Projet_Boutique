-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 nov. 2023 à 11:09
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
(3000, 'le produit', 'cat 2', 53.00, '\r\nfreestar\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus sollicitudin lectus sit amet consequat. Sed a ipsum commodo ipsum commodo dictum ut eget augue. Ut tempus sollicitudin ligula a ultricies. Nulla rutrum turpis ut nisi porta semper. Nunc faucibus non magna ut elementum. Ut venenatis metus est, eget maximus nisl finibus a. Sed vehicula nunc leo, vitae eleifend ante convallis vel. Sed a condimentum ligula. Aenean eu placerat sapien, id varius enim. Nunc nisi quam, commodo at magna eget, bibendum mollis neque. Aenean sagittis vel erat ac mattis. Nulla facilisi. Nulla dapibus suscipit velit, vel gravida felis ornare eget. Duis eget viverra diam, sit amet dignissim purus. Proin risus massa, placerat venenatis scelerisque et, fringilla ac metus. Aliquam eget lorem mattis, tincidunt ex nec, pharetra urna.', 'https://media.istockphoto.com/id/587200944/fr/vectoriel/panneau-attention-de.jpg?s=612x612&w=0&k=20&c=yqDCx0Wq680n0oKVgDYkrfdb8R9_-55RR-qRVbZ47HI=', 26, 'https://buy.stripe.com/9AQcPd38l6EI8lafYY'),
(3001, 'encore un produit', 'le test', 153.00, 'Vestibulum sed interdum orci. Phasellus feugiat eu orci nec accumsan. Curabitur sodales justo eu lectus molestie, quis tincidunt libero fermentum. Proin vitae velit eu enim gravida condimentum. Cras id rhoncus elit, in vulputate lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean eget interdum risus.', 'https://media.istockphoto.com/id/1221750570/fr/vectoriel/exclamation-mark-signe-davertissement-au-sujet-dune-urgence.jpg?s=612x612&w=0&k=20&c=VB9nY5mtTTXdet2-sZSsKoHIXrdTS_zlkofi-utmhaE=', 59, 'https://buy.stripe.com/4gw02reR34wA1WM4gh'),
(3012, 'Smartphone Galaxy S22', 'Électronique', 799.99, 'Le dernier smartphone de Samsung avec des fonctionnalités avancées.', 'https://www.backmarket.fr/cdn-cgi/image/format%3Dauto%2Cquality%3D75%2Cwidth%3D640/https://d2e6ccujb3mkqf.cloudfront.net/b12fbd31-2d50-4762-ab43-2c9b60475aa6-1_9d95cc77-8d37-47bb-a3bb-330b75274b1a.jpg', 100, 'https://buy.stripe.com/aEU7uT38l8MQ44UeUW'),
(3013, 'Laptop Ultrabook ZenBook Pro', 'Informatique', 1299.99, 'Un ultrabook puissant avec un écran tactile 4K pour les professionnels.', 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/notebooks/xps-notebooks/xps-15-9530/media-gallery/touch-black/notebook-xps-15-9530-t-black-gallery-1.psd?fmt=png-alpha&pscan=auto&scl=1&hei=402&wid=654&qlt=100,1&r', 80, 'https://buy.stripe.com/00g9D17oB5AEcBq003'),
(3014, 'Enceinte Bluetooth Ultimate Boom', 'Audio', 149.99, 'Une enceinte portable étanche avec un son exceptionnel pour vos aventures en plein air.', 'https://boulanger.scene7.com/is/image/Boulanger/5099206080287_h_f_l_0?wid=500&hei=500', 120, 'https://buy.stripe.com/bIYcPdbER4wAdFufZ2'),
(3015, 'Montre connectée FitPro 2000', 'Électronique', 129.50, 'Une montre intelligente avec suivi de la condition physique, GPS intégré et écran AMOLED.', 'https://www.gabrielrivaz.com/4667-large_default/montre-connectee-fitpro-silicone-noir.jpg', 90, 'https://buy.stripe.com/bIYbL938l2os30QbIN'),
(3016, 'Appareil photo numérique Lumix 4K', 'Photo et Caméscopes', 699.75, 'Capturez des images incroyables avec cet appareil photo 4K de Panasonic.', 'https://image.darty.com/image_son/photo_numerique/appareil_photo/panasonic_tz90_s2304287549032A_135816126.png', 110, 'https://buy.stripe.com/00gaH524h9QU30QfZ4'),
(3017, 'Cafetière automatique Deluxe', 'Cuisine et Maison', 79.99, 'Préparez le café parfait à chaque fois avec cette cafetière automatique haut de gamme.', 'https://www.nespresso.com/ecom/medias/sys_master/public/12715488641054/Desktop-PDP-6272x2432.jpg?impolicy=productPdpMainDefault&imwidth=1568', 70, 'https://buy.stripe.com/fZe4iH38ld36eJy6ov'),
(3018, 'Tondeuse à gazon PowerMaster', 'Jardin', 299.00, 'Une tondeuse à gazon robuste avec une puissance maximale pour un jardin impeccable.', 'https://www.nemura.fr/wp-content/uploads/2023/02/TD196A-big.jpg.webp', 95, 'https://buy.stripe.com/14kbL9fV78MQ44UaEM'),
(3019, 'Ensemble de valises Voyager', 'Bagages', 189.25, 'Un ensemble de valises élégantes et durables pour tous vos voyages.', 'https://www.mesbagages.com/images/bagages/valise-madisson-875030z.jpg', 105, 'https://buy.stripe.com/5kA4iH38l4wAcBq9AJ'),
(3020, 'Console de jeu Quantum X', 'Jeux vidéo', 449.99, 'Une console de jeu de nouvelle génération avec des graphismes époustouflants et une expérience immersive.', 'https://static.fnac-static.com/multimedia/Images/39/39/B3/67/424761-3-1520-3/tsp20221201151627/Microsoft-Xbox-One-Quantum-Break-Bundle-console-de-jeux-500-Go-HDD-noir.jpg', 85, 'https://buy.stripe.com/4gwdTh7oB4wA58YaEO'),
(3021, 'Vélo électrique EcoRider', 'Sports et Loisirs', 899.50, 'Explorez la ville avec facilité grâce à ce vélo électrique écologique.', 'https://alerion-cycles.com/cdn/shop/products/a_black_1_720x.png?v=1682277883', 75, 'https://buy.stripe.com/6oE6qPeR3e7a58Y14f');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3022;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
