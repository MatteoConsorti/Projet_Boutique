-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 nov. 2023 à 08:41
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
-- Base de données : `btque`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `panier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `adresse`, `email`, `mot_de_passe`, `panier_id`) VALUES
(4000, 'son nom', 'le rue ou il habite', 'sonemail@email.com', 'password', 4000),
(4001, 'un autre', 'une autre ville', 'autremail@mail.com', '1234', 4001);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenue`
--

CREATE TABLE `contenue` (
  `clients_id` int(11) DEFAULT NULL,
  `produits_id` int(11) DEFAULT NULL,
  `quantité` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenue`
--

INSERT INTO `contenue` (`clients_id`, `produits_id`, `quantité`) VALUES
(4000, 3001, 30),
(4000, 3000, 19),
(4001, 3000, 15);

-- --------------------------------------------------------

--
-- Structure de la table `nosproduits`
--

CREATE TABLE `nosproduits` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `contenue_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `contenue_id`) VALUES
(4000, 4000),
(4001, 4001);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `categorie`, `prix`, `description`, `image`, `stock`) VALUES
(3000, 'le produit', 'cat 2', 53.00, '\n\nfreestar\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus sollicitudin lectus sit amet consequat. Sed a ipsum commodo ipsum commodo dictum ut eget augue. Ut tempus sollicitudin ligula a ultricies. Nulla rutrum turpis ut nisi porta semper. Nunc faucibus non magna ut elementum. Ut venenatis metus est, eget maximus nisl finibus a. Sed vehicula nunc leo, vitae eleifend ante convallis vel. Sed a condimentum ligula. Aenean eu placerat sapien, id varius enim. Nunc nisi quam, commodo at magna eget, bibendum mollis neque. Aenean sagittis vel erat ac mattis. Nulla facilisi. Nulla dapibus suscipit velit, vel gravida felis ornare eget. Duis eget viverra diam, sit amet dignissim purus. Proin risus massa, placerat venenatis scelerisque et, fringilla ac metus. Aliquam eget lorem mattis, tincidunt ex nec, pharetra urna.', 'https://media.istockphoto.com/id/587200944/fr/vectoriel/panneau-attention-de.jpg?s=612x612&w=0&k=20&c=yqDCx0Wq680n0oKVgDYkrfdb8R9_-55RR-qRVbZ47HI=', 26),
(3001, 'encore un produit', 'le test', 153.00, 'Vestibulum sed interdum orci. Phasellus feugiat eu orci nec accumsan. Curabitur sodales justo eu lectus molestie, quis tincidunt libero fermentum. Proin vitae velit eu enim gravida condimentum. Cras id rhoncus elit, in vulputate lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean eget interdum risus.', 'https://media.istockphoto.com/id/1221750570/fr/vectoriel/exclamation-mark-signe-davertissement-au-sujet-dune-urgence.jpg?s=612x612&w=0&k=20&c=VB9nY5mtTTXdet2-sZSsKoHIXrdTS_zlkofi-utmhaE=', 59);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `clients_ibfk_1` (`panier_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contenue`
--
ALTER TABLE `contenue`
  ADD KEY `contenue_ibfk_1` (`clients_id`),
  ADD KEY `contenue_ibfk_2` (`produits_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panier_ibfk_1` (`contenue_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4002;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3002;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `contenue`
--
ALTER TABLE `contenue`
  ADD CONSTRAINT `contenue_ibfk_1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `contenue_ibfk_2` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`contenue_id`) REFERENCES `contenue` (`clients_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
