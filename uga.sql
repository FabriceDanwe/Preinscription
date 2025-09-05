-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : lun. 30 juin 2025 à 12:50
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `uga`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `objet` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cycles`
--

DROP TABLE IF EXISTS `cycles`;
CREATE TABLE IF NOT EXISTS `cycles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cycles`
--

INSERT INTO `cycles` (`id`, `nom`) VALUES
(1, 'Licence'),
(2, 'Master'),
(4, 'Licence Professionnelle'),
(5, 'Master Professionnel');

-- --------------------------------------------------------

--
-- Structure de la table `facultes`
--

DROP TABLE IF EXISTS `facultes`;
CREATE TABLE IF NOT EXISTS `facultes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `sigle` varchar(20) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `facultes`
--

INSERT INTO `facultes` (`id`, `nom`, `sigle`, `description`) VALUES
(1, 'Ecole Supérieure des Sciences Economiques et Commerciales', 'ESSEC', NULL),
(2, 'Faculté de Médecine et des Sciences Biomédicales', 'FMSB', NULL),
(3, 'Faculté des Sciences Economiques et de Gestion', 'FSEG', NULL),
(4, 'Faculté des Sciences Juridiques et Politiques', 'FSJP', NULL),
(5, 'Faculté des Sciences de l\'Education', 'FSE', NULL),
(6, 'Faculté des Arts, Lettres et Sciences Humaines', 'FALSH', NULL),
(7, 'Faculté des Sciences', 'FS', NULL),
(8, 'Institut Supérieur des Beaux Arts et de l\'Innovation', 'IBAI', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

DROP TABLE IF EXISTS `parcours`;
CREATE TABLE IF NOT EXISTS `parcours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculte_id` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faculte_id` (`faculte_id`),
  KEY `cycle_id` (`cycle_id`),
  KEY `niveau_id` (`niveau_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `preinscriptions`
--

DROP TABLE IF EXISTS `preinscriptions`;
CREATE TABLE IF NOT EXISTS `preinscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `date_nais` date NOT NULL,
  `dateprecise` enum('True','False') NOT NULL,
  `lieu_nais` varchar(150) NOT NULL,
  `sexe` enum('M','F') NOT NULL,
  `num_cni` varchar(100) DEFAULT NULL,
  `adresse_perso` varchar(150) NOT NULL,
  `stat_matri` enum('MARIE(E)','CELIBATAIRE','DIVORCE(E)') NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `langue` enum('FRANÇAIS','ANGLAIS') NOT NULL,
  `sit_prof` enum('SANS EMPLOI','SALARIE(E)','EN AUTO-EMPLOI') NOT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `lieu_affectation` varchar(100) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `ech` varchar(2) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `dept_origine` varchar(100) DEFAULT NULL,
  `arrondissement_id` varchar(100) DEFAULT NULL,
  `nom_pere` varchar(100) DEFAULT NULL,
  `profession_pere` varchar(100) DEFAULT NULL,
  `nom_mere` varchar(100) NOT NULL,
  `profession_mere` varchar(100) NOT NULL,
  `nom_urgence` varchar(100) NOT NULL,
  `tel_urgence` varchar(20) NOT NULL,
  `ville_urgence` varchar(100) NOT NULL,
  `cycle_id` varchar(50) DEFAULT NULL,
  `niveau_id` varchar(50) DEFAULT NULL,
  `parcour_id` varchar(50) DEFAULT NULL,
  `fill2` varchar(50) DEFAULT NULL,
  `etab1` varchar(100) DEFAULT NULL,
  `class1` varchar(100) DEFAULT NULL,
  `etab2` varchar(100) DEFAULT NULL,
  `class2` varchar(100) DEFAULT NULL,
  `etab3` varchar(100) DEFAULT NULL,
  `class3` varchar(100) DEFAULT NULL,
  `etab4` varchar(100) DEFAULT NULL,
  `class4` varchar(100) DEFAULT NULL,
  `etab5` varchar(100) DEFAULT NULL,
  `class5` varchar(100) DEFAULT NULL,
  `diplome` varchar(100) NOT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `annee_obtention` int(4) NOT NULL,
  `moyenne` decimal(4,2) DEFAULT NULL,
  `mention` enum('PASSABLE','ASSEZ BIEN','BIEN','TRES BIEN','EXCELLENT','PASSED') NOT NULL,
  `pays_diplome` varchar(50) DEFAULT NULL,
  `dipl_etabl` varchar(100) NOT NULL,
  `dipl_date_deli` date NOT NULL,
  `nbre_paper` int(2) DEFAULT '0',
  `sport` text,
  `art` text,
  `handicap` enum('Oui','Non') NOT NULL DEFAULT 'Non',
  `num_certifmedical` varchar(30) DEFAULT NULL,
  `lieu_certifmedical` varchar(200) DEFAULT NULL,
  `sujet` text,
  `nom_directeur` varchar(100) DEFAULT NULL,
  `grade_directeur` varchar(100) DEFAULT NULL,
  `institution_directeur` varchar(50) DEFAULT NULL,
  `nom_codirecteur` varchar(100) DEFAULT NULL,
  `grade_codirecteur` varchar(100) DEFAULT NULL,
  `institution_codirecteur` varchar(50) DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `preinscriptions`
--

INSERT INTO `preinscriptions` (`id`, `reference`, `nom`, `prenom`, `date_nais`, `dateprecise`, `lieu_nais`, `sexe`, `num_cni`, `adresse_perso`, `stat_matri`, `tel`, `email`, `langue`, `sit_prof`, `profession`, `lieu_affectation`, `grade`, `ech`, `nationality`, `region`, `dept_origine`, `arrondissement_id`, `nom_pere`, `profession_pere`, `nom_mere`, `profession_mere`, `nom_urgence`, `tel_urgence`, `ville_urgence`, `cycle_id`, `niveau_id`, `parcour_id`, `fill2`, `etab1`, `class1`, `etab2`, `class2`, `etab3`, `class3`, `etab4`, `class4`, `etab5`, `class5`, `diplome`, `serie`, `annee_obtention`, `moyenne`, `mention`, `pays_diplome`, `dipl_etabl`, `dipl_date_deli`, `nbre_paper`, `sport`, `art`, `handicap`, `num_certifmedical`, `lieu_certifmedical`, `sujet`, `nom_directeur`, `grade_directeur`, `institution_directeur`, `nom_codirecteur`, `grade_codirecteur`, `institution_codirecteur`, `date_creation`) VALUES
(1, 'PRE-20250627-685EEE9CEC721', 'HAYNEWA', 'Faire ', '1992-11-11', 'True', 'kjhkjhjh', 'M', '', 'GAROUA', 'MARIE(E)', '691942826', 'accueil@univ-yaounde1.cm', 'FRANÇAIS', 'SANS EMPLOI', '', '', '', '', '1', '2', '1', '1', '', '', 'KEDA', 'MILL', '69185624', '69521555', 'GAROUA', '1', '1', '1', '1', 'LYCÉE ', '2014', '', '', '', '', '', '', '', '', 'BACC', 'TI', 2020, '10.00', 'PASSABLE', 'CMR', 'OBC', '2020-11-14', 0, NULL, '', 'Non', '', '', '', '', '', '', '', '', '', '2025-06-27 20:18:52'),
(2, 'PRE-20250627-685EF27CAE03F', 'BAWANE', 'ODETTE', '1998-12-02', 'True', 'MAROUA', 'F', '', 'GAROUA', 'MARIE(E)', '697517664', 'accueil@univ-yaounde1.cm', 'FRANÇAIS', 'SANS EMPLOI', '', '', '', '', '1', '2', '1', '1', '', '', 'MM', 'MMM', '691856243', '695215557', 'GAROUA', '2', '4', '2', '1', 'LYCÉE ', '2014', '', '', '', '', '', '', '', '', 'BACC', 'A', 2020, '10.00', 'PASSABLE', 'CMR', 'OBC', '2020-11-07', 0, NULL, '', 'Non', '', '', '', '', '', '', '', '', '', '2025-06-27 20:35:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
