-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 nov. 2023 à 15:14
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
(12, 19, 'Appareil photo numérique Lumix 4K', 1, 699.00, '2023-11-24 14:08:58');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
