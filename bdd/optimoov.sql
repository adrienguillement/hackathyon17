-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 08 oct. 2017 à 21:43
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

-- --------------------------------------------------------

--
-- Structure de la table `bornes`
--

CREATE TABLE `bornes` (
  `id` int(11) NOT NULL,
  `id_station` varchar(8) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `type_recharge` varchar(255) NOT NULL DEFAULT 'Normale et accélérée',
  `nbr_points_recharge` int(2) NOT NULL DEFAULT '2',
  `type_connecteur_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bornes`
--

INSERT INTO `bornes` (`id`, `id_station`, `adresse`, `ville`, `code_postal`, `lat`, `lng`, `type_recharge`, `nbr_points_recharge`, `type_connecteur_id`) VALUES
(1, '3VE001', 'Espace Villeneuve - Route de Challans', 'AIZENAY', 85190, 46.7435, -1.61386, 'Normale et accélérée', 2, 1),
(2, '003VE002', 'Place de la Mutualité - Rue Hôtel de Ville', 'AIZENAY', 85190, 46.7402, -1.60784, 'Normale et accélérée', 2, 1),
(3, '008VE001', 'Rue Louis Pasteur', 'AUBIGNY', 85430, 46.597, -1.4523, 'Normale et accélérée', 2, 2),
(4, '012VE001', 'Chemin du Querruy', 'LA BARRE DE MONTS', 85550, 46.8849, -2.11837, 'Normale et accélérée', 2, 2),
(5, '014VE001', 'Rue Georges Clémenceau', 'BAZOGES EN PAREDS', 85390, 46.6571, -0.91576, 'Normale et accélérée', 2, 2),
(6, '020VE001', 'Place du Champ de Foire - Rue de la Gare', 'BENET', 85490, 46.3694, -0.59512, 'Normale et accélérée', 2, 1),
(7, '027VE001', 'Rue du fléchet', 'BOUFFÉRÉ', 85600, 46.9577, -1.35084, 'Rapide', 1, 3),
(8, '034VE001', 'Place des Papillons', 'BOURNEZEAU', 85480, 46.6361, -1.17294, 'Normale et accélérée', 2, 2),
(9, '035VE001', 'Parking des Halles', 'BRETIGNOLLES SUR MER', 85470, 46.6268, -1.8556, 'Normale et accélérée', 2, 2),
(10, '042VE001', 'Parking rue du 8 Mai', 'CHAILLE LES MARAIS', 85450, 46.393, -1.02199, 'Normale et accélérée', 2, 1),
(11, '046VE001', 'Place du Marché', 'LA CHAIZE LE VICOMTE', 85310, 46.6721, -1.29272, 'Normale et accélérée', 2, 1),
(12, '047VE001', 'Route de Nantes', 'CHALLANS', 85300, 46.8612, -1.86452, 'Rapide', 1, 3),
(13, '047VE002', 'Place de l\'Europe - passage Carnot', 'CHALLANS', 85300, 46.8456, -1.88028, 'Normale et accélérée', 2, 1),
(14, '047VE003', 'Parking Dodin', 'CHALLANS', 85300, 46.8444, -1.87921, 'Normale et accélérée', 2, 1),
(15, '051VE003', 'Place de la Gare', 'CHANTONNAY', 85110, 46.6898, -1.05425, 'Normale et accélérée', 2, 2),
(16, '051VE005', 'Place Jeanne d\'Arc', 'CHANTONNAY', 85110, 46.6863, -1.05157, 'Normale et accélérée', 2, 2),
(17, '059VE001', 'Place de la République', 'LA CHATAIGNERAIE', 85120, 46.6472, -0.74243, 'Normale et accélérée', 2, 2),
(18, '060VE001', 'Parking Millet - Rue Séraphin Buton', 'LE CHÂTEAU D\'OLONNE', 85180, 46.5048, -1.73754, 'Normale et accélérée', 2, 1),
(19, '060VE002', 'Parking de Tanchet', 'LE CHÂTEAU D\'OLONNE', 85180, 46.4812, -1.75905, 'Normale et accélérée', 2, 1),
(20, '070VE001', 'Place du Docteur Brechoteau', 'COEX', 85220, 46.6974, -1.76012, 'Normale et accélérée', 2, 2),
(21, '081VE001', 'Rue Margerie - Parking péri-scolaire', 'DOMPIERRE SUR YON', 85170, 46.739, -1.38599, 'Normale et accélérée', 2, 2),
(22, '084VE001', 'Place de l\'Eglise', 'LES ESSARTS', 85140, 46.7729, -1.22665, 'Normale et accélérée', 2, 1),
(23, '084VE002', 'Place de la Mairie', 'LES ESSARTS', 85140, 46.7742, -1.23013, 'Normale et accélérée', 2, 1),
(24, '089VE001', 'Place du Marché', 'LA FERRIERE', 85280, 46.714, -1.31272, 'Normale et accélérée', 2, 1),
(25, '092VE001', 'Pôle d\'échange Multi Usages - Rue Gérard Guérin', 'FONTENAY LE COMTE', 85200, 46.462, -0.80859, 'Normale et accélérée', 2, 1),
(26, '092VE002', 'Place Thiverçay - Rue Georges Clémenceau', 'FONTENAY LE COMTE', 85200, 46.4665, -0.80692, 'Normale et accélérée', 2, 1),
(27, '092VE004', 'Place de Verdun', 'FONTENAY LE COMTE', 85200, 46.4623, -0.80221, 'Rapide', 1, 3),
(28, '096VE001', 'Place de la Mairie', 'LA GARNACHE', 85710, 46.891, -1.83061, 'Normale et accélérée', 2, 2),
(29, '109VE001', 'Place des Droits de l\'Homme', 'LES HERBIERS', 85500, 46.8714, -1.00948, 'Normale et accélérée', 2, 1),
(30, '109VE002', 'Place du Champ de Foire', 'LES HERBIERS', 85500, 46.8732, -1.01449, 'Normale et accélérée', 2, 1),
(31, '109VE003', 'Rue du Baron Pierre de Coubertin', 'LES HERBIERS', 85500, 46.8615, -1.01728, 'Normale et accélérée', 2, 1),
(32, '113VE001', 'Parking embarcadère - Quai de la Mairie', 'L\'ILE D\'YEU', 85350, 46.7243, -2.34753, 'Normale et accélérée', 2, 2),
(33, '113VE002', 'Parking Héliport - Rue des Quais', 'L\'ILE D\'YEU', 85350, 46.7277, -2.35018, 'Normale et accélérée', 2, 2),
(34, '114VE001', 'Rue Biaille de Langibaudière', 'JARD SUR MER', 85520, 46.4164, -1.57682, 'Normale et accélérée', 2, 1),
(35, '128VE001', 'Place du Général Leclerc', 'LUÇON', 85400, 46.4545, -1.16827, 'Normale et accélérée', 2, 1),
(36, '128VE002', 'Place des anciens abattoirs - Rue du Moulin Rouget', 'LUÇON', 85400, 46.4533, -1.15782, 'Normale et accélérée', 2, 1),
(37, '135VE001', 'Ilôt Marillet - Place des Halles', 'MAREUIL SUR LAY DISSAIS', 85320, 46.5363, -1.22376, 'Normale et accélérée', 2, 1),
(38, '146VE001', 'Place du Pont Jarley', 'MONTAIGU', 85600, 46.9741, -1.31215, 'Normale et accélérée', 2, 1),
(39, '150VE001', 'Place du Pont de l\'Issoire', 'MORMAISON', 85260, 46.9063, -1.45214, 'Normale et accélérée', 2, 2),
(40, '151VE001', 'Avenue de la Gare', 'MORTAGNE SUR SEVRE', 85290, 46.9951, -0.94492, 'Normale et accélérée', 2, 2),
(41, '151VE002', 'Place de la Roseraie - Rue de la Fontaine', 'MORTAGNE SUR SEVRE', 85290, 46.9914, -0.95255, 'Normale et accélérée', 2, 2),
(42, '152VE001', 'Place de l\'Hôtel de Ville', 'LA MOTHE ACHARD', 85150, 46.6177, -1.65902, 'Normale et accélérée', 2, 2),
(43, '155VE001', 'Rue des oiseaux', 'MOUILLERON LE CAPTIF', 85000, 46.7203, -1.45963, 'Normale et accélérée', 2, 1),
(44, '163VE001', 'Place de la Prée aux Ducs', 'NOIRMOUTIER EN L\'ILE', 85330, 47.0007, -2.24947, 'Normale et accélérée', 2, 2),
(45, '166VE001', 'Rue des Sables - Office de Tourisme', 'OLONNE SUR MER', 85340, 46.5341, -1.77327, 'Normale et accélérée', 2, 1),
(46, '166VE002', 'Parking du Havre - Rue des Bosquets', 'OLONNE SUR MER', 85340, 46.5419, -1.7726, 'Normale et accélérée', 2, 1),
(47, '166VE003', 'Olonnespace - Allée des Cèdres', 'OLONNE SUR MER', 85340, 46.5064, -1.77019, 'Normale et accélérée', 2, 1),
(48, '172VE001', 'Rue du Général de Gaulle', 'LE PERRIER', 85300, 46.8199, -1.98991, 'Normale et accélérée', 2, 2),
(49, '178VE001', 'Parking Rue de La Brachetière', 'LE POIRE SUR VIE', 85170, 46.7661, -1.50551, 'Normale et accélérée', 2, 1),
(50, '178VE002', 'Rue de La Chapelle', 'LE POIRE SUR VIE', 85170, 46.7679, -1.50769, 'Normale et accélérée', 2, 1),
(51, '182VE001', 'Place de Lattre de Tassigny', 'POUZAUGES', 85700, 46.782, -0.83792, 'Normale et accélérée', 2, 2),
(52, '182VE002', 'Rue Joachim Rouault', 'POUZAUGES', 85700, 46.7782, -0.8416, 'Normale et accélérée', 2, 2),
(53, '190VE001', 'Rue du Grand Moulin', 'ROCHESERVIERE', 85620, 46.9407, -1.50997, 'Normale et accélérée', 2, 2),
(54, '191VE001', 'Rue Anatole France', 'LA ROCHE SUR YON', 85000, 46.671, -1.4282, 'Normale et accélérée', 2, 1),
(55, '191VE002', 'Place de la Vendée', 'LA ROCHE SUR YON', 85000, 46.6692, -1.43181, 'Normale et accélérée', 2, 1),
(56, '191VE004', 'Boulevard Leclerc', 'LA ROCHE SUR YON', 85000, 46.6725, -1.43743, 'Normale et accélérée', 2, 1),
(57, '191VE005', 'Parking des Oudairies', 'LA ROCHE SUR YON', 85000, 46.6704, -1.40609, 'Normale et accélérée', 2, 1),
(58, '191VE006', 'Maison de quartier Saint André d\'Ornay - Chemin Guy Bourrieau', 'LA ROCHE SUR YON', 85000, 46.6659, -1.45374, 'Normale et accélérée', 2, 1),
(59, '191VE007', 'Place de la Mutualité - Rue du Général Guérin', 'LA ROCHE SUR YON', 85000, 46.6609, -1.40277, 'Normale et accélérée', 2, 1),
(60, '191VE008', 'Place de Coubertin - Bd Réaumur', 'LA ROCHE SUR YON', 85000, 46.6691, -1.44083, 'Normale et accélérée', 2, 1),
(61, '191VE009', 'Boulevard Sully', 'LA ROCHE SUR YON', 85000, 46.6829, -1.43236, 'Normale et accélérée', 2, 1),
(62, '191VE010', 'Boulevard des Etats Unis', 'LA ROCHE SUR YON', 85000, 46.6642, -1.42502, 'Normale et accélérée', 2, 1),
(63, '191VE011', 'Impasse Bécquerel', 'LA ROCHE SUR YON ', 85000, 46.691, -1.42832, 'Rapide', 1, 3),
(64, '191VE017', 'Place du Genêt', 'LA ROCHE SUR YON ', 85000, 46.6505, -1.4383, 'Rapide', 1, 3),
(65, '194VE002', 'Cours Dupont', 'LES SABLES D\'OLONNE', 85100, 46.4972, -1.78187, 'Normale et accélérée', 2, 2),
(66, '194VE004', 'Quai Albert Prouteau-Port Olonna', 'LES SABLES D\'OLONNE', 85100, 46.5019, -1.79613, 'Normale et accélérée', 2, 1),
(67, '194VE005', 'Rue Nicot', 'LES SABLES D\'OLONNE', 85100, 46.4994, -1.78418, 'Normale et accélérée', 2, 2),
(68, '194VE006', 'Place Maraud - Quai des Boucaniers', 'LES SABLES D\'OLONNE', 85100, 46.494, -1.79573, 'Normale et accélérée', 2, 2),
(69, '197VE001', 'Rue de la Mairie', 'SAINT ANDRE TREIZE VOIES', 85260, 46.9341, -1.41197, 'Normale et accélérée', 2, 2),
(70, '212VE001', 'Les Quatre Chemins', 'SAINTE FLORENCE', 85140, 46.8117, -1.13728, 'Rapide', 1, 3),
(71, '215VE001', 'Parking de la Communauté de Communes - rue Jules Verne', 'SAINT FULGENT', 85250, 46.8512, -1.17026, 'Normale et accélérée', 2, 1),
(72, '215VE002', 'Place de la Mairie', 'SAINT FULGENT', 85250, 46.8509, -1.17687, 'Normale et accélérée', 2, 2),
(73, '216VE001', 'Les Quatre Chemins', 'STE GEMME LA PLAINE', 85400, 46.4669, -1.10895, 'Rapide', 1, 3),
(74, '217VE001', 'Place Raymond Dronneau ', 'SAINT GEORGES DE MONTAIGU', 85600, 46.9474, -1.29718, 'Normale et accélérée', 2, 1),
(75, '222VE001', 'Place de la Cour Rouge', 'SAINT GILLES CROIX DE VIE', 85800, 46.6978, -1.92586, 'Normale et accélérée', 2, 2),
(76, '226VE001', 'Rue des Pins', 'SAINT HILAIRE DE RIEZ', 85270, 46.7209, -1.94701, 'Normale et accélérée', 2, 2),
(77, '226VE002', 'Avenue de l\'Isle de Riez', 'SAINT HILAIRE DE RIEZ', 85270, 46.7112, -1.96324, 'Normale et accélérée', 2, 2),
(78, '226VE003', 'Rue Lucien Collinet', 'SAINT HILAIRE DE RIEZ', 85270, 46.7128, -1.9781, 'Normale et accélérée', 2, 2),
(79, '243VE001', 'Rue du Champ Prieur', 'BREM SUR MER', 85470, 46.6063, -1.83562, 'Normale et accélérée', 2, 2),
(80, '294VE001', 'Rue du Perthuis Breton', 'LA TRANCHE SUR MER', 85360, 46.3477, -1.43012, 'Normale et accélérée', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `poids` float(10,2) NOT NULL,
  `autonomie` float(10,1) NOT NULL,
  `epa` float(10,2) NOT NULL COMMENT 'Wh/km',
  `SCx` float(10,3) DEFAULT NULL,
  `MAX_AC` float(10,2) NOT NULL,
  `tension_max_chargeur_ac` int(5) NOT NULL,
  `courant_max_chargeur_ac` int(3) NOT NULL,
  `MAX_DC` int(3) NOT NULL,
  `tension_max_chargeur_dc` int(4) NOT NULL,
  `courant_max_chargeur_dc` int(4) NOT NULL,
  `capacite_batterie` float(10,2) NOT NULL,
  `rendement` float(10,2) NOT NULL,
  `coefficient_resistance_roulement` float(10,3) NOT NULL,
  `vitesse_maximale` int(3) NOT NULL,
  `puissance_recuperee` float(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id`, `libelle`, `poids`, `autonomie`, `epa`, `SCx`, `MAX_AC`, `tension_max_chargeur_ac`, `courant_max_chargeur_ac`, `MAX_DC`, `tension_max_chargeur_dc`, `courant_max_chargeur_dc`, `capacite_batterie`, `rendement`, `coefficient_resistance_roulement`, `vitesse_maximale`, `puissance_recuperee`) VALUES
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
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `code_postal` int(5) DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `vehicule_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `mail`, `adresse`, `code_postal`, `ville`, `vehicule_id`) VALUES
(1, 'Adrien', 'Guillement', 'adrien.guillement@gmail.com', '3 rue des terrières', 85310, 'La Chaize-le-vicomte', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `modele_id` int(11) DEFAULT NULL,
  `puissanceAccessoires` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'KW',
  `type_prise_id` int(11) DEFAULT NULL,
  `pourcentage_batterie` int(3) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `modele_id`, `puissanceAccessoires`, `type_prise_id`, `pourcentage_batterie`) VALUES
(1, 17, 0.00, 2, 80);

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
  ADD KEY `typePrise_id` (`type_prise_id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`type_prise_id`) REFERENCES `type_prise` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
