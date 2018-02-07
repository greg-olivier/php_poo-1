-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `catalogue`
--
CREATE DATABASE IF NOT EXISTS `catalogue` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `catalogue`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(10) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `id_auteur` int(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `publier` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `id_auteur` int(10) NOT NULL,
  `login_auteur` varchar(100) NOT NULL,
  `pwd_auteur` varchar(255) NOT NULL,
  `titre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`login_auteur`, `pwd_auteur`, `titre`) VALUES
('1234', '$2y$10$BNorHqrr2Mi7WUoqy1Nibe68ivqcJFTSOaCRHlqrTi7yi76nrmwx2', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `titre`) VALUES
(1, 'Categorie 1'),
(2, 'Categorie 2'),
(3, 'Categorie 3');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `objet` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `interets` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` text,
  `prix` decimal(6,0) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `publier` tinyint(1) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `contenu`, `prix`, `image`, `date`, `id_cat`, `publier`, `thumbnail`) VALUES
(1, 'Article 1', 'Curabitur quis nibh quam. Phasellus semper enim eu quam ultrices, et luctus quam porta. Maecenas erat justo, elementum rutrum nisl non, egestas tristique nulla. Vivamus nibh nisl, viverra viverra molestie vitae, finibus sit amet mi. In eleifend dapibus dolor eu congue. Maecenas rutrum mattis quam, malesuada tincidunt libero sodales et. Vestibulum non tempus neque, vitae egestas dui. ', '1500', 'img_480x360.jpg', '2018-01-01', 3, 1, 'img_240x180.jpg'),
(2, 'Article 2', 'Suspendisse potenti. Praesent dictum id tortor id ultrices. Phasellus feugiat vehicula nisl, at congue erat finibus a. Suspendisse elit turpis, condimentum sit amet mauris et, tempor facilisis leo. Phasellus tincidunt iaculis fringilla. Sed non lectus eget orci pretium dictum quis eget leo. Curabitur accumsan lorem diam, vehicula elementum elit tristique a. Nulla mauris lectus, fringilla non mollis vitae, posuere sit amet risus. In fringilla commodo lacinia. Integer interdum elit purus, porttitor dapibus mauris blandit eget. ', '59', 'img_480x360.jpg', '2018-01-04', 2, 1, 'img_240x180.jpg'),
(3, 'Article 3', 'Duis eget erat scelerisque, euismod risus vel, pharetra magna. Proin ac ultrices nisl, vitae laoreet magna. Donec vitae dignissim ligula. Mauris ut nunc sagittis, finibus ligula vel, tincidunt erat. Vestibulum consectetur, nibh eu tempus venenatis, nibh diam efficitur est, id hendrerit diam felis viverra justo. Sed id mi at arcu viverra posuere. Nulla finibus ex ac dui aliquam molestie. Mauris porttitor massa vitae molestie interdum. ', '250', 'img_480x360.jpg', '2018-01-03', 2, 1, 'img_240x180.jpg'),
(4, 'Article 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor orci eget diam ultricies elementum. Cras tincidunt vel felis sed placerat. Cras ac metus sed orci ultricies tristique. Sed eu sollicitudin mauris. Vestibulum lobortis lacinia nunc a porta. Morbi accumsan nulla at nibh sagittis, eu semper purus consequat. Duis eu dui eu orci sodales gravida at id nulla. Integer faucibus ut ipsum in pulvinar. Sed nisi velit, interdum congue accumsan in, vehicula interdum diam. Pellentesque id varius tellus. Fusce non nulla nisi. Nulla mollis felis non augue faucibus, eget hendrerit ipsum mollis. Nam mollis varius commodo. ', '39', 'img_480x360.jpg', '2018-08-01', 1, 1, 'img_240x180.jpg'),
(5, 'Article 5', 'Pellentesque at varius nunc, sit amet cursus diam. Nam ut tellus a erat aliquam interdum. Sed vel vestibulum arcu. Curabitur varius mauris in condimentum suscipit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras quam felis, sodales sed ligula et, sodales ornare arcu. Nunc tempor blandit finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam ultrices justo eget libero convallis sagittis. Nulla rhoncus laoreet tellus id rhoncus. Aliquam a erat eu metus accumsan mollis quis eu nibh. ', '99', 'img_480x360.jpg', '2018-01-07', 1, 1, 'img_240x180.jpg'),
(6, 'Article 6', 'Aliquam erat volutpat. Vivamus feugiat lacus eget ipsum scelerisque, sagittis auctor dui venenatis. Maecenas malesuada felis vitae placerat tempor. Integer cursus dolor ut elit iaculis commodo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent quis ipsum id quam facilisis tincidunt. Nunc eget elit libero. Aliquam ac maximus neque, sit amet molestie est. Aenean in porta nisl, vitae suscipit orci. Curabitur maximus tincidunt nisl. Morbi a ligula vitae nisl gravida placerat eget vitae justo. Proin in bibendum libero. Etiam in nunc at lorem hendrerit feugiat in vel mauris. Fusce diam odio, convallis at dolor id, luctus viverra neque. Etiam vel mi rhoncus libero sollicitudin gravida id viverra augue. ', '1200', 'img_480x360.jpg', '2018-01-05', 3, 1, 'img_240x180.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `tags_pdts`
--

CREATE TABLE `tags_pdts` (
  `id_tag` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tags_pdts`
--

INSERT INTO `tags_pdts` (`id_tag`, `id`) VALUES
(1, 1),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 4),
(2, 6),
(3, 2),
(3, 3),
(3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `tag_pdt`
--

CREATE TABLE `tag_pdt` (
  `id_tag` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tag_pdt`
--

INSERT INTO `tag_pdt` (`id_tag`, `nom`) VALUES
(1, 'Promo'),
(2, 'En vedette'),
(3, 'Nouveautés');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_edito_id_auteur` (`id_auteur`);

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id_auteur`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Index pour la table `tags_pdts`
--
ALTER TABLE `tags_pdts`
  ADD PRIMARY KEY (`id_tag`,`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `tag_pdt`
--
ALTER TABLE `tag_pdt`
  ADD PRIMARY KEY (`id_tag`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id_auteur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tag_pdt`
--
ALTER TABLE `tag_pdt`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`);

--
-- Contraintes pour la table `tags_pdts`
--
ALTER TABLE `tags_pdts`
  ADD CONSTRAINT `tags_pdts_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tag_pdt` (`id_tag`),
  ADD CONSTRAINT `tags_pdts_ibfk_2` FOREIGN KEY (`id`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
