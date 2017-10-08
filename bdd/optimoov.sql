-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 07 oct. 2017 à 17:44
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `optimoov`
--
CREATE DATABASE IF NOT EXISTS `optimoov` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `optimoov`;

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `poids` float(10,2) NOT NULL,
  `autonomie` float(10,1) NOT NULL,
  `Wh/km` float(10,2) NOT NULL,
  `SCx` float(10,3) DEFAULT NULL,
  `MAX_AC` float(10,2) NOT NULL,
  `tension_max_chargeur_ac` int(5) NOT NULL,
  `courant_max_chargeur_ac` int(3) NOT NULL,
  `MAX_DC` int(3) NOT NULL,
  `tension_max_chargeur_dc` int(4) NOT NULL,
  `courant_max_chargeur_dc` int(4) NOT NULL,
  `capactie_batterie` float(10,2) NOT NULL,
  `rendement` float(10,2) NOT NULL,
  `coefficient_resistance_roulement` float(10,3) NOT NULL,
  `vitesse_maximale` int(3) NOT NULL,
  `puissance_recuperee` float(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id`, `libelle`, `poids`, `autonomie`, `Wh/km`, `SCx`, `MAX_AC`, `tension_max_chargeur_ac`, `courant_max_chargeur_ac`, `MAX_DC`, `tension_max_chargeur_dc`, `courant_max_chargeur_dc`, `capactie_batterie`, `rendement`, `coefficient_resistance_roulement`, `vitesse_maximale`, `puissance_recuperee`) VALUES
(1, 'BMW i3', 1245.00, 129.6, 254.63, 0.700, 6.40, 400, 16, 50, 400, 125, 33.00, 0.75, 0.015, 150, 0.4),
(2, 'Chevrolet Bolt', 1625.00, 400.0, 150.00, 0.700, 0.00, 0, 0, 0, 0, 0, 60.00, 0.75, 0.015, 146, 0.4),
(3, 'Chevrolet Volt', 1719.00, 85.0, 188.24, 0.500, 3.68, 230, 16, 0, 0, 0, 16.00, 0.75, 0.015, 161, 0.5),
(4, 'Citro?n C-Zero', 1080.00, 150.0, 106.67, 0.706, 3.68, 230, 16, 50, 400, 125, 16.00, 0.75, 0.015, 130, 0.4),
(5, 'Ford Focus Electric', 1647.00, 121.6, 189.14, 0.642, 7.36, 230, 32, 0, 0, 0, 23.00, 0.75, 0.015, 136, 0.4),
(6, 'Hyundai ioniq electric', 1420.00, 280.0, 100.00, 0.480, 12.80, 400, 32, 0, 0, 0, 28.00, 0.75, 0.015, 165, 0.4),
(7, 'Mercedes-Benz Classe B E.D', 1725.00, 139.2, 206.90, 0.600, 6.40, 400, 16, 0, 0, 0, 28.80, 0.75, 0.015, 160, 0.4),
(8, 'Nissan Leaf', 1535.00, 134.4, 223.21, 0.600, 7.36, 230, 32, 50, 400, 125, 30.00, 0.75, 0.015, 144, 0.4),
(9, 'Nissan e-NV200', 1540.00, 136.0, 176.47, 0.850, 7.36, 230, 32, 50, 400, 125, 24.00, 0.75, 0.015, 123, 0.4),
(10, 'Opel Ampera-e', 1625.00, 520.0, 115.38, 0.640, 7.36, 230, 32, 50, 400, 125, 60.00, 0.75, 0.015, 150, 0.4),
(11, 'Peugeot - iOn', 1080.00, 150.0, 106.67, 0.706, 3.68, 230, 16, 50, 400, 125, 16.00, 0.75, 0.015, 140, 0.4),
(12, 'Renault Kangoo ZE', 1520.00, 136.0, 161.76, 0.970, 3.68, 230, 16, 0, 0, 0, 22.00, 0.75, 0.015, 130, 0.4),
(13, 'Renault Zoe', 1400.00, 210.0, 104.76, 0.750, 12.80, 400, 32, 0, 0, 0, 22.00, 0.75, 0.015, 140, 0.4),
(14, 'Tesla Model S 85D', 2100.00, 384.0, 221.35, 0.500, 12.80, 400, 32, 0, 0, 0, 85.00, 0.75, 0.015, 250, 0.4),
(15, 'Tesla Model S P85D', 2100.00, 550.0, 154.55, 0.500, 12.80, 400, 32, 0, 0, 0, 85.00, 0.71, 0.015, 250, 0.4),
(16, 'Tesla Model X 70D', 2200.00, 413.0, 169.49, 0.550, 12.80, 400, 32, 0, 0, 0, 70.00, 0.75, 0.015, 210, 0.4),
(17, 'Tesla Model X 90D', 2390.00, 504.0, 178.57, 0.550, 12.80, 400, 32, 0, 0, 0, 90.00, 0.75, 0.015, 250, 0.5),
(18, 'VW- Golf Blue e-motion', 1545.00, 300.0, 88.33, 0.600, 3.68, 230, 16, 0, 0, 0, 26.00, 0.75, 0.015, 160, 0.4);

-- --------------------------------------------------------

--
-- Structure de la table `type_prise`
--

CREATE TABLE `type_prise` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_prise`
--

INSERT INTO `type_prise` (`id`, `libelle`) VALUES
(1, 'type 1'),
(2, 'type 2'),
(3, 'type CHAdeMO');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code_postal` int(5) NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vehicule_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `modele_id` int(11) NOT NULL,
  `puissanceAccessoires` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'KW',
  `typePrise_id` int(11) NOT NULL,
  `pourcentage_batterie` float(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_prise`
--
ALTER TABLE `type_prise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicule_id` (`vehicule_id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `typePrise_id` (`typePrise_id`),
  ADD KEY `modele_id` (`modele_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `type_prise`
--
ALTER TABLE `type_prise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`typePrise_id`) REFERENCES `type_prise` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
