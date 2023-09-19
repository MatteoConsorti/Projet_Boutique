-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 sep. 2023 à 10:25
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
-- Base de données : `boutique_tel`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `ID_PRODUIT` int(50) NOT NULL,
  `NOM_PRODUIT` varchar(255) NOT NULL,
  `DESCRIPTION_PRODUIT` varchar(255) NOT NULL,
  `PRIX_PRODUIT` int(50) NOT NULL,
  `STOCK_PRODUIT` int(50) NOT NULL,
  `MARQUE_TEL` varchar(10) NOT NULL,
  `MODELE_TEL` varchar(100) NOT NULL,
  `CARACTERISTIQUE_TEL` varchar(100) NOT NULL,
  `URL_IMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`ID_PRODUIT`, `NOM_PRODUIT`, `DESCRIPTION_PRODUIT`, `PRIX_PRODUIT`, `STOCK_PRODUIT`, `MARQUE_TEL`, `MODELE_TEL`, `CARACTERISTIQUE_TEL`, `URL_IMAGE`) VALUES
(1, 'iPhone 13 Pro', 'Le dernier smartphone phare d\'Apple avec une caméra triple, un écran Super Retina XDR et une puce A15 Bionic.\r\n', 1099, 500, 'iPhone', 'A2649', 'Caméra ultra grand-angle, mode nuit amélioré.\r\n', 'https://proxymedia.woopic.com/api/v1/images/1618%2Fedithor%2Fterminaux%2FiPhone_14_Pro_Deep_Purple_PDP_Image_Position-1a__FRFR_6329876d4d67a850e7ca4d2a.jpg?format=480x480&saveas=webp&saveasquality=80'),
(2, 'Samsung Galaxy Z Fold 3\r\n\r\n', 'Un téléphone pliable de Samsung avec un grand écran pliable, stylet S Pen et une performance puissante.', 1799, 300, 'Samsung', 'SM-F926U', 'Écran pliable Dynamic AMOLED 2X.', 'https://images.samsung.com/is/image/samsung/fr-feature-galaxy-z-fold3-5g-494412212?$FB_TYPE_I_JPG$'),
(3, 'Google Pixel 6 Pro\r\n\r\n', ' Le dernier smartphone Google avec une caméra avancée, une puce Tensor personnalisée et Android 12.', 899, 400, 'Google', 'G512B', 'Caméra ultra grand-angle avec capteur de 12 MP.', 'https://m.media-amazon.com/images/I/6191aDbiwjL.jpg'),
(4, 'OnePlus 9\r\n\r\n', 'Un téléphone OnePlus avec un écran fluide AMOLED, une charge rapide et un processeur Snapdragon 888.', 699, 250, 'OnePlus', 'IN2010', 'Charge Warp 65T.', 'https://www.backmarket.fr/cdn-cgi/image/format%3Dauto%2Cquality%3D75%2Cwidth%3D640/https://d2e6ccujb3mkqf.cloudfront.net/13560315-0ad3-4ff2-98f5-7abf613b4a68-1_8b786d91-3fd2-4de9-b3b1-775657f42b04.jpg'),
(5, 'Sony Xperia 1 III\r\n\r\n', 'Un smartphone Sony avec un écran 4K, un appareil photo Zeiss et une prise casque 3,5 mm.', 1199, 150, 'Sony', 'XQ-BC72\r\n', 'Écran OLED 4K HDR.', 'https://www.sony.fr/image/bec37fd1196426136aae242507e874b0?fmt=pjpeg&wid=330&bgcolor=FFFFFF&bgc=FFFFFF'),
(6, 'Xiaomi Mi 11 Ultra', 'Un téléphone Xiaomi avec une caméra triple de 50 MP, un écran AMOLED 2K et un Snapdragon 888.', 1199, 350, 'Xiaomi', 'M2102K1C', 'Écran secondaire à l\'arrière pour les selfies.', 'https://cdn.lesnumeriques.com/optim/product/62/62059/8ca72c64-mi-11-ultra__450_400.jpeg'),
(7, 'LG Velvet\r\n\r\n', 'Un smartphone LG élégant avec un écran OLED, une conception élégante et une caméra polyvalente.', 599, 100, 'LG', 'LM-G900N', 'Caméra principale de 48 MP.', 'https://m.media-amazon.com/images/I/71i+5gVbBsL.jpg'),
(8, 'Motorola Moto G Power (2021)\r\n\r\n', 'Un téléphone Motorola abordable avec une batterie massive de 5 000 mAh et un écran Max Vision.', 199, 700, 'Motorola', 'XT2117-4', 'Autonomie de batterie exceptionnelle.', 'https://fr.moviles.com/fotos/motorola-moto-g-power-2021-88912-g.jpg'),
(9, '8.3 5G', 'Un téléphone Nokia 5G avec un écran PureDisplay, des mises à jour Android garanties et une grande connectivité.', 599, 200, 'Nokia', 'TA-1243', 'Connectivité 5G.', 'https://www.backmarket.fr/cdn-cgi/image/format%3Dauto%2Cquality%3D75%2Cwidth%3D640/https://d2e6ccujb3mkqf.cloudfront.net/743326f0-c0ca-48b6-93da-a6e9463bca6f-1_e3c87b98-55e9-4a47-8805-d732f57d4edd.jpg'),
(10, 'Asus ROG Phone 5', 'Un téléphone gaming d\'Asus avec un écran AMOLED de 144 Hz, des boutons AirTrigger 5 et une puissance de jeu ultime.', 799, 120, 'Asus', 'ZS673KS', 'Écran de jeu avec taux de rafraîchissement élevé.', 'https://www.accessoires-asus.com/infos/image.php?c=MTA0OTc4&w=L2ltYWdlcy9zaXRlcy8xL3dhdGVyLnBuZw%3D%3D&f=em9vbS83ODk0OTYyNjcxMTIuanBn');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`ID_PRODUIT`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `ID_PRODUIT` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
