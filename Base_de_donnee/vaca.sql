-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 18 mai 2022 à 21:52
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
-- Base de données : `vaca`
--

-- --------------------------------------------------------

--
-- Structure de la table `accesmateriel`
--

DROP TABLE IF EXISTS `accesmateriel`;
CREATE TABLE IF NOT EXISTS `accesmateriel` (
  `id_espece` decimal(10,0) NOT NULL,
  `id_type_mat` decimal(10,0) NOT NULL,
  `acces_materiel` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `accesrace`
--

DROP TABLE IF EXISTS `accesrace`;
CREATE TABLE IF NOT EXISTS `accesrace` (
  `id_profil` decimal(10,0) NOT NULL,
  `id_race` decimal(10,0) NOT NULL,
  `acces_race` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `accesrace`
--

INSERT INTO `accesrace` (`id_profil`, `id_race`, `acces_race`) VALUES
('1', '6', 1),
('5', '2', 1),
('4', '9', 1),
('7', '9', 1),
('3', '9', 1),
('11', '1', 0),
('11', '2', 0),
('11', '3', 1),
('11', '4', 0),
('11', '5', 0),
('11', '6', 0),
('11', '7', 0),
('11', '8', 0),
('11', '9', 0),
('11', '10', 0),
('11', '11', 0),
('11', '12', 0),
('11', '13', 0),
('11', '14', 0),
('11', '15', 0),
('11', '16', 0),
('11', '17', 0),
('11', '18', 0),
('11', '19', 0),
('11', '20', 0),
('12', '20', 0),
('12', '19', 0),
('12', '18', 0),
('12', '17', 0),
('12', '16', 0),
('12', '15', 0),
('12', '14', 0),
('12', '13', 0),
('12', '12', 0),
('12', '11', 1),
('12', '10', 0),
('12', '9', 1),
('12', '8', 0),
('12', '7', 0),
('12', '6', 0),
('12', '5', 0),
('12', '4', 0),
('12', '3', 1),
('12', '2', 0),
('12', '1', 0),
('13', '1', 0),
('13', '2', 0),
('13', '3', 1),
('13', '4', 0),
('13', '5', 0),
('13', '6', 0),
('13', '7', 0),
('13', '8', 0),
('13', '9', 0),
('13', '10', 0),
('13', '11', 0),
('13', '12', 0),
('13', '13', 0),
('13', '14', 0),
('13', '15', 0),
('13', '16', 0),
('13', '17', 0),
('13', '18', 0),
('13', '19', 0),
('13', '20', 0),
('14', '1', 0),
('14', '2', 0),
('14', '3', 0),
('14', '4', 0),
('14', '5', 0),
('14', '6', 0),
('14', '7', 0),
('14', '8', 0),
('14', '9', 1),
('14', '10', 0),
('14', '11', 0),
('14', '12', 0),
('14', '13', 0),
('14', '14', 0),
('14', '15', 0),
('14', '16', 0),
('14', '17', 0),
('14', '18', 0),
('14', '19', 0),
('14', '20', 0),
('15', '1', 0),
('15', '2', 0),
('15', '3', 1),
('15', '4', 0),
('15', '5', 0),
('15', '6', 0),
('15', '7', 0),
('15', '8', 0),
('15', '9', 0),
('15', '10', 0),
('15', '11', 0),
('15', '12', 0),
('15', '13', 0),
('15', '14', 0),
('15', '15', 0),
('15', '16', 0),
('15', '17', 0),
('15', '18', 0),
('15', '19', 0),
('15', '20', 0),
('16', '1', 0),
('16', '2', 0),
('16', '3', 0),
('16', '4', 0),
('16', '5', 0),
('16', '6', 0),
('16', '7', 0),
('16', '8', 0),
('16', '9', 0),
('16', '10', 0),
('16', '11', 1),
('16', '12', 0),
('16', '13', 0),
('16', '14', 0),
('16', '15', 0),
('16', '16', 0),
('16', '17', 0),
('16', '18', 0),
('16', '19', 0),
('16', '20', 0),
('17', '1', 0),
('17', '2', 0),
('17', '3', 0),
('17', '4', 0),
('17', '5', 0),
('17', '6', 0),
('17', '7', 0),
('17', '8', 0),
('17', '9', 0),
('17', '10', 0),
('17', '11', 1),
('17', '12', 0),
('17', '13', 0),
('17', '14', 0),
('17', '15', 0),
('17', '16', 0),
('17', '17', 0),
('17', '18', 0),
('17', '19', 0),
('17', '20', 0),
('18', '1', 1),
('18', '2', 1),
('18', '3', 1),
('18', '4', 1),
('18', '5', 1),
('18', '6', 1),
('18', '7', 1),
('18', '8', 1),
('18', '9', 1),
('18', '10', 1),
('18', '11', 1),
('18', '12', 1),
('18', '13', 1),
('18', '14', 1),
('18', '15', 1),
('18', '16', 1),
('18', '17', 1),
('18', '18', 1),
('18', '19', 1),
('18', '20', 1),
('19', '1', 0),
('19', '2', 0),
('19', '3', 0),
('19', '4', 0),
('19', '5', 0),
('19', '6', 1),
('19', '7', 0),
('19', '8', 0),
('19', '9', 0),
('19', '10', 0),
('19', '11', 0),
('19', '12', 0),
('19', '13', 0),
('19', '14', 0),
('19', '15', 0),
('19', '16', 0),
('19', '17', 0),
('19', '18', 0),
('19', '19', 0),
('19', '20', 0),
('20', '1', 0),
('20', '2', 0),
('20', '3', 0),
('20', '4', 0),
('20', '5', 0),
('20', '6', 0),
('20', '7', 0),
('20', '8', 0),
('20', '9', 1),
('20', '10', 0),
('20', '11', 0),
('20', '12', 0),
('20', '13', 0),
('20', '14', 0),
('20', '15', 0),
('20', '16', 0),
('20', '17', 0),
('20', '18', 0),
('20', '19', 0),
('20', '20', 0),
('21', '1', 1),
('21', '2', 0),
('21', '3', 0),
('21', '4', 0),
('21', '5', 0),
('21', '6', 0),
('21', '7', 0),
('21', '8', 0),
('21', '9', 0),
('21', '10', 0),
('21', '11', 0),
('21', '12', 0),
('21', '13', 0),
('21', '14', 0),
('21', '15', 0),
('21', '16', 0),
('21', '17', 0),
('21', '18', 0),
('21', '19', 0),
('21', '20', 0),
('22', '1', 0),
('22', '2', 0),
('22', '3', 1),
('22', '4', 0),
('22', '5', 0),
('22', '6', 0),
('22', '7', 0),
('22', '8', 0),
('22', '9', 0),
('22', '10', 0),
('22', '11', 0),
('22', '12', 0),
('22', '13', 0),
('22', '14', 0),
('22', '15', 0),
('22', '16', 0),
('22', '17', 0),
('22', '18', 0),
('22', '19', 0),
('22', '20', 0);

-- --------------------------------------------------------

--
-- Structure de la table `actus`
--

DROP TABLE IF EXISTS `actus`;
CREATE TABLE IF NOT EXISTS `actus` (
  `id_actu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_photo` decimal(10,0) DEFAULT NULL,
  `titre` varchar(254) DEFAULT NULL,
  `texte` mediumtext,
  `date_saisie` date NOT NULL,
  `lien` mediumtext,
  `date_suppression` date DEFAULT NULL,
  `date_publication` date DEFAULT NULL,
  PRIMARY KEY (`id_actu`),
  UNIQUE KEY `id_actu` (`id_actu`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `actus`
--

INSERT INTO `actus` (`id_actu`, `id_photo`, `titre`, `texte`, `date_saisie`, `lien`, `date_suppression`, `date_publication`) VALUES
(1, NULL, 'Salon de l\'agriculture', 'Venez dÃ©couvrir le salon de l\'agriculture !\r\nSUPER\r\nYOUHOU\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\noui', '2022-04-29', NULL, '2022-05-03', '2022-04-29'),
(2, NULL, 'Grippe Aviaire', 'Oh no c\'est la cata\r\nSauvez les canards\r\nbouhou\r\nOn a plus de pÃ¢tÃ©', '2022-04-29', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley', '2022-05-19', '2022-04-29');

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_famille` decimal(10,0) DEFAULT NULL,
  `id_mere` decimal(10,0) DEFAULT NULL,
  `id_sexe` char(1) NOT NULL,
  `id_race` decimal(10,0) NOT NULL,
  `id_pere` decimal(10,0) DEFAULT NULL,
  `id_exploit` decimal(10,0) DEFAULT NULL,
  `identifiant_animal` varchar(254) NOT NULL,
  `surnom` varchar(254) DEFAULT NULL,
  `annee_naissance` int(11) DEFAULT NULL,
  `date_prochainVeto` date DEFAULT NULL,
  `attribution` bigint(20) DEFAULT NULL,
  `statut_reformation` tinyint(1) DEFAULT NULL,
  `statut_convention` tinyint(1) DEFAULT NULL,
  `en_attente` tinyint(1) DEFAULT NULL,
  `commentaire_animal` mediumtext,
  PRIMARY KEY (`id_animal`),
  UNIQUE KEY `id_animal` (`id_animal`),
  KEY `Mère` (`id_pere`) USING BTREE,
  KEY `Père` (`id_mere`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=636 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id_animal`, `id_famille`, `id_mere`, `id_sexe`, `id_race`, `id_pere`, `id_exploit`, `identifiant_animal`, `surnom`, `annee_naissance`, `date_prochainVeto`, `attribution`, `statut_reformation`, `statut_convention`, `en_attente`, `commentaire_animal`) VALUES
(320, NULL, NULL, 'M', '2', NULL, NULL, '3310551428', 'Mercure', 2016, NULL, NULL, 0, 1, 0, ''),
(319, NULL, NULL, 'M', '2', NULL, NULL, '32', 'Oudin', 2018, NULL, NULL, 0, 1, 0, ''),
(318, NULL, NULL, 'M', '6', NULL, '12', 'FR 277894 81162', '', NULL, NULL, NULL, 0, 1, 0, ''),
(317, NULL, NULL, 'M', '6', NULL, '12', 'FR 278046 81095', '', NULL, NULL, NULL, 0, 1, 0, ''),
(316, NULL, NULL, 'M', '6', NULL, '12', 'FR 278046 71075', '', NULL, NULL, NULL, 0, 1, 0, ''),
(315, NULL, NULL, 'M', '6', NULL, '12', 'FR 278046 40029', '', NULL, NULL, NULL, 0, 1, 0, ''),
(314, NULL, NULL, 'M', '6', NULL, '12', 'FR 278046 81016', '', NULL, NULL, NULL, 0, 1, 0, ''),
(313, NULL, NULL, 'M', '6', NULL, '12', 'FR 278721 21016', '', NULL, NULL, NULL, 0, 1, 0, ''),
(312, NULL, NULL, 'M', '6', NULL, '12', 'FR 277894 81128', '', NULL, NULL, NULL, 0, 1, 0, ''),
(311, NULL, NULL, 'M', '6', NULL, '12', 'FR 278309 21004', '', NULL, NULL, NULL, 0, 1, 0, ''),
(310, NULL, NULL, 'M', '6', NULL, '12', 'FR 271540 95047', '', NULL, NULL, NULL, 0, 1, 0, ''),
(309, NULL, NULL, 'F', '2', NULL, NULL, '3310599382', 'Rony', 2020, '2022-05-20', NULL, 0, 1, 0, ''),
(308, NULL, NULL, 'M', '6', NULL, '12', '07322482 E', 'Tapageur du Parc', NULL, NULL, NULL, 0, 1, 0, ''),
(307, NULL, NULL, 'M', '2', NULL, NULL, '3310583710', 'Rohan', 2020, NULL, 5, 0, 1, 1, ''),
(306, '10', NULL, 'F', '2', NULL, NULL, '3310583076', 'Pimousse', 2019, NULL, NULL, 0, 1, 0, ''),
(305, NULL, NULL, 'M', '2', NULL, NULL, '3330228824', 'Neptune', 2017, NULL, NULL, 0, 1, 1, ''),
(304, NULL, NULL, 'F', '1', NULL, '14', 'FR 3310565965', '', NULL, NULL, NULL, 0, 1, 0, ''),
(303, NULL, NULL, 'M', '6', NULL, '12', '27826221012', '', NULL, NULL, NULL, 0, 1, 1, ''),
(302, '4', NULL, 'F', '2', NULL, NULL, 'FR 3330246300', 'Romance', NULL, NULL, NULL, 0, 1, 0, ''),
(301, NULL, NULL, 'F', '1', NULL, '14', 'FR 3310565966', '5966', 2017, NULL, NULL, 0, 1, 0, ''),
(300, NULL, NULL, 'F', '1', NULL, '14', 'FR 3310200171', 'UNULLnime', 2003, '2022-05-18', NULL, 0, 1, 0, ''),
(299, NULL, NULL, 'M', '6', NULL, '12', 'FR 278046 81187', '', NULL, NULL, NULL, 0, 1, 0, ''),
(298, NULL, NULL, 'M', '6', NULL, '12', '27804602098', '', NULL, NULL, NULL, 0, 1, 0, ''),
(297, '3', NULL, 'F', '2', NULL, NULL, 'FR 3330233994', 'Opale', 2018, NULL, NULL, 0, 1, 0, ''),
(296, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414806399', '6399', NULL, NULL, NULL, 0, 1, 0, ''),
(295, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414707688', 'Ovidie', NULL, NULL, NULL, 0, 1, 0, ''),
(294, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414119528', 'Jolie', NULL, NULL, NULL, 0, 1, 0, ''),
(293, NULL, NULL, 'F', '1', NULL, '14', 'FR 3310565960', '5960', 2016, NULL, NULL, 0, 1, 0, ''),
(292, NULL, NULL, 'F', '1', NULL, '14', 'FR 3340021971', 'Flabute', 2010, NULL, NULL, 0, 1, 0, ''),
(291, '7', NULL, 'F', '2', NULL, NULL, 'FR 6414929629', 'Pervanche', NULL, NULL, NULL, 0, 1, 0, ''),
(290, '7', NULL, 'F', '2', NULL, NULL, 'FR 6414686220', 'Noisette', 2017, NULL, NULL, 0, 1, 0, ''),
(289, '3', NULL, 'F', '2', NULL, NULL, 'FR 3310551694', 'Moutchie', 2016, NULL, NULL, 0, 1, 0, ''),
(288, NULL, NULL, 'F', '1', NULL, '14', 'FR 6411381654', 'Marie', NULL, NULL, NULL, 0, 1, 0, ''),
(287, NULL, NULL, 'F', '1', NULL, '14', 'FR 4632974022', 'Tirouette', NULL, NULL, NULL, 0, 1, 1, ''),
(286, NULL, NULL, 'F', '6', NULL, '12', '18138007 Z', 'Ibiza de L\'Aurore', NULL, NULL, NULL, 0, 1, 0, ''),
(285, NULL, NULL, 'F', '6', NULL, '12', '17513972 Y', 'Harmonie de Barbanne', 2017, NULL, NULL, 0, 1, 0, ''),
(284, NULL, NULL, 'M', '11', NULL, '11', 'FR 277524 71010', 'Chevrou', NULL, NULL, 3, 0, 1, 0, ''),
(283, NULL, NULL, 'F', '11', NULL, '11', 'FR 275446 50002', 'chevrette', NULL, NULL, NULL, 0, 1, 0, ''),
(282, NULL, NULL, 'F', '11', NULL, '11', 'FR 275446 50003', 'chavire', NULL, NULL, NULL, 0, 1, 0, ''),
(281, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414806397', '6397', NULL, NULL, NULL, 0, 1, 0, ''),
(280, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414806396', '6396', NULL, NULL, NULL, 0, 1, 0, ''),
(279, NULL, NULL, 'F', '1', NULL, '14', 'FR 4632974039', 'Baggy', NULL, NULL, NULL, 0, 1, 0, ''),
(278, '1', NULL, 'F', '2', NULL, NULL, 'FR 4728007708', 'Jacynthe', 2014, NULL, NULL, 0, 1, 0, ''),
(277, '4', NULL, 'F', '2', NULL, NULL, 'FR 4730055484', 'Pipelette', 2019, NULL, NULL, 0, 1, 0, ''),
(276, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414586274', '6274', NULL, NULL, NULL, 0, 1, 0, ''),
(275, NULL, NULL, 'F', '1', NULL, '14', 'FR 3310524616', 'IrÃ©nÃ©e', NULL, NULL, NULL, 0, 1, 0, ''),
(274, NULL, NULL, 'F', '1', NULL, '14', 'FR 6411544744', 'ValÃ©rie', NULL, NULL, NULL, 0, 1, 0, ''),
(273, '4', NULL, 'F', '2', NULL, NULL, 'FR 64 1468 6219', 'Mirza', 2016, NULL, NULL, 0, 1, 0, ''),
(272, '1', NULL, 'F', '2', NULL, NULL, 'FR 2405843775', 'RÃ©sine', 2020, NULL, NULL, 0, 1, 0, ''),
(271, '4', NULL, 'F', '2', NULL, NULL, 'FR 64 1492 9628', 'Pepita', 2019, NULL, NULL, 0, 1, 0, ''),
(270, NULL, NULL, 'F', '7', NULL, NULL, '52804760 W', 'Petite Lune', NULL, NULL, NULL, 0, 1, 0, ''),
(269, NULL, NULL, 'F', '7', NULL, NULL, '52800765 N', 'Bizi', NULL, NULL, NULL, 0, 1, 0, ''),
(268, '6', NULL, 'F', '2', NULL, NULL, 'FR 3310569590', 'Orchis', 2018, NULL, NULL, 0, 1, 0, ''),
(267, '9', NULL, 'F', '2', NULL, NULL, 'FR 4730007233', 'Princesse', 2019, NULL, NULL, 0, 1, 0, ''),
(266, '2', NULL, 'F', '2', NULL, NULL, 'FR 4728001397', 'Irlande', 2013, NULL, NULL, 0, 1, 0, ''),
(265, '8', NULL, 'F', '2', NULL, NULL, 'FR 3310456315', 'Ginon', 2011, NULL, NULL, 0, 1, 0, ''),
(264, '7', NULL, 'F', '2', NULL, NULL, 'FR 6413161375', 'Hermine', 2012, NULL, NULL, 0, 1, 0, ''),
(263, '1', NULL, 'F', '2', NULL, NULL, 'FR 4730047920', 'Pervenche', 2019, NULL, NULL, 0, 1, 0, ''),
(262, '6', NULL, 'F', '2', NULL, NULL, 'FR 4004406218', 'Marquise', 2016, NULL, NULL, 0, 1, 0, ''),
(261, '6', NULL, 'F', '2', NULL, NULL, 'FR 3310583075', 'Promise', 2019, NULL, NULL, 0, 1, 0, ''),
(260, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414806377', 'Olympe', NULL, NULL, 1, 0, 1, 0, ''),
(259, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414707686', 'NoÃ©mie', NULL, NULL, NULL, 0, 1, 0, ''),
(258, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414586281', '6281', NULL, NULL, NULL, 0, 1, 1, ''),
(257, '3', NULL, 'F', '2', NULL, NULL, 'FR 3310583074', 'Pilulaire', 2019, NULL, NULL, 0, 1, 0, ''),
(256, NULL, NULL, 'F', '7', NULL, NULL, '52778964 K', 'Bibane Ainhoa', NULL, '2022-05-11', NULL, 0, 1, 0, ''),
(255, NULL, NULL, 'M', '6', NULL, '12', 'FR 277894 81158', '', NULL, NULL, NULL, 0, 1, 0, ''),
(254, '5', NULL, 'F', '2', NULL, NULL, 'FR 6414554074', 'Kiterie', 2015, NULL, NULL, 0, 1, 0, ''),
(253, '5', NULL, 'F', '2', NULL, NULL, 'FR 6414718260', 'Papillone', 2019, NULL, NULL, 0, 1, 0, ''),
(252, NULL, NULL, 'M', '6', NULL, '12', 'FR 278046 02008', '', NULL, NULL, NULL, 0, 1, 0, ''),
(251, NULL, NULL, 'M', '6', NULL, '12', 'FR 277894 81148', '', NULL, '2022-05-20', NULL, 0, 1, 1, ''),
(250, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414586273', '6273', NULL, NULL, NULL, 0, 1, 0, ''),
(249, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414333004', 'Merise', NULL, NULL, NULL, 0, 1, 0, ''),
(248, NULL, NULL, 'F', '1', NULL, '14', 'FR 6411768161', 'Ictoire', NULL, NULL, NULL, 0, 1, 0, ''),
(247, NULL, NULL, 'F', '1', NULL, '14', 'FR 6412118701', 'Fenoulhet', NULL, NULL, NULL, 0, 1, 0, ''),
(246, '2', NULL, 'F', '2', NULL, NULL, 'FR 3310544805', 'Liesse', 2015, NULL, NULL, 0, 1, 0, ''),
(245, NULL, NULL, 'F', '1', NULL, '14', 'FR 3310007536', 'Promise', NULL, NULL, NULL, 0, 1, 0, ''),
(244, NULL, NULL, 'F', '1', NULL, '14', 'FR 6414929630', 'Pascaline', NULL, NULL, NULL, 0, 1, 0, ''),
(243, '4', NULL, 'F', '2', NULL, NULL, 'FR 6414929632', 'Paquita', 2019, NULL, NULL, 0, 1, 0, ''),
(242, NULL, NULL, 'F', '2', NULL, NULL, '3310581789', 'Pelita', 2019, NULL, NULL, 0, 1, 0, ''),
(241, '3', NULL, 'F', '2', NULL, NULL, 'FR 3310594399', 'Ritchie', 2020, NULL, NULL, 0, 1, 0, ''),
(240, '3', NULL, 'F', '2', NULL, NULL, 'FR 3330223138', 'Origami', 2018, NULL, NULL, 0, 1, 0, ''),
(239, '2', NULL, 'F', '2', NULL, NULL, 'FR 3310556871', 'Noblesse', 2017, NULL, NULL, 0, 1, 0, ''),
(238, '1', '309', 'F', '2', NULL, NULL, 'FR 3310551698', 'Nynthe', 2017, NULL, NULL, 0, 1, 0, ''),
(620, '5', '123456789', 'M', '9', NULL, '8', 'MT 320', 'Landais1', 2003, NULL, 7, NULL, NULL, NULL, NULL),
(622, NULL, '123456789', 'M', '9', NULL, '8', 'MT 5689', 'Landais 2', 2017, NULL, 3, 0, 1, NULL, NULL),
(623, '4', '302', 'M', '2', '307', NULL, 'FR39', 'philibert', 2020, NULL, 5, 0, 0, 0, NULL),
(624, NULL, NULL, 'M', '12', NULL, '4', '1COCO1', 'LEON LE COCHON', 2011, '2023-01-10', 7, NULL, NULL, NULL, NULL),
(625, NULL, NULL, 'M', '3', NULL, '9', 'FR', 'coq', 2017, NULL, NULL, 0, 0, 0, NULL),
(626, NULL, NULL, 'M', '3', NULL, '9', 'FR 42', 'coq', 2017, NULL, 15, 0, 0, 0, NULL),
(627, NULL, NULL, 'M', '3', NULL, '15', 'FR 45', 'bouc', 2016, NULL, 9, 0, 0, 0, NULL),
(628, NULL, NULL, 'M', '3', NULL, '9', 'FR', 'bouc', 2016, NULL, NULL, 0, 0, 0, NULL),
(629, NULL, NULL, 'F', '3', NULL, '9', 'FR', 'boucette', 2016, NULL, NULL, 0, 0, 0, NULL),
(630, NULL, '629', 'F', '3', '628', '9', 'FR', 'Pune', 2020, NULL, NULL, 0, 0, 0, NULL),
(631, NULL, '629', 'F', '3', '626', '9', 'FR', 'Prune', 2017, NULL, NULL, 0, 0, 0, NULL),
(632, NULL, NULL, 'F', '3', NULL, '9', 'FR 48', 'boulette', 2019, NULL, NULL, 0, 0, 1, NULL),
(633, NULL, NULL, 'M', '11', NULL, '11', 'FR 86', 'verne', 2015, NULL, NULL, 0, 0, 1, NULL),
(634, NULL, NULL, 'M', '11', NULL, '11', 'FR 67', 'Babou', 2011, NULL, NULL, 0, 0, 1, NULL),
(635, NULL, NULL, 'F', '11', NULL, '11', 'FR 56', 'Bebou', 2013, NULL, NULL, 0, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `attributiondesanimaux`
--

DROP TABLE IF EXISTS `attributiondesanimaux`;
CREATE TABLE IF NOT EXISTS `attributiondesanimaux` (
  `id_animal` decimal(10,0) NOT NULL,
  `id_demande` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_animal`,`id_demande`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `attributiondesanimaux`
--

INSERT INTO `attributiondesanimaux` (`id_animal`, `id_demande`) VALUES
('249', '11'),
('250', '11'),
('284', '19'),
('298', '3'),
('312', '10'),
('620', '1'),
('620', '31'),
('622', '2'),
('622', '32'),
('626', '27'),
('626', '28'),
('626', '29'),
('627', '15'),
('627', '16'),
('627', '17'),
('633', '22'),
('633', '23'),
('633', '24'),
('633', '25'),
('633', '26'),
('633', '30');

-- --------------------------------------------------------

--
-- Structure de la table `attributiondesexploitations`
--

DROP TABLE IF EXISTS `attributiondesexploitations`;
CREATE TABLE IF NOT EXISTS `attributiondesexploitations` (
  `id_exploit` decimal(10,0) NOT NULL,
  `id_profil` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_exploit`,`id_profil`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `attributiondesexploitations`
--

INSERT INTO `attributiondesexploitations` (`id_exploit`, `id_profil`) VALUES
('1', '1'),
('2', '2'),
('3', '3'),
('3', '7'),
('4', '4'),
('5', '6'),
('5', '11'),
('6', '9'),
('7', '12'),
('7', '13'),
('8', '14'),
('9', '15'),
('10', '16'),
('11', '17'),
('13', '20'),
('14', '21'),
('15', '22');

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

DROP TABLE IF EXISTS `commune`;
CREATE TABLE IF NOT EXISTS `commune` (
  `id_commune` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `commune` varchar(254) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  PRIMARY KEY (`id_commune`),
  UNIQUE KEY `id_commune` (`id_commune`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`id_commune`, `commune`, `code_postal`) VALUES
(1, 'Pessac', '33600'),
(2, 'Gradignan', '33170'),
(3, 'Talence ', '33400');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_profil` decimal(10,0) NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `mail` varchar(254) DEFAULT NULL,
  `nom_contact` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_contact`),
  UNIQUE KEY `id_contact` (`id_contact`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `id_profil`, `tel`, `mail`, `nom_contact`) VALUES
(9, '22', '012030405', 'benrard@mail', 'bernard'),
(8, '15', '0011223344', 'jc@mail', 'Jean Claude');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_duree` decimal(10,0) NOT NULL,
  `id_type_demande` decimal(10,0) NOT NULL,
  `id_statutTran` decimal(10,0) DEFAULT NULL,
  `id_statutDem` decimal(10,0) DEFAULT NULL,
  `id_profil` decimal(10,0) DEFAULT NULL,
  `id_materiel` decimal(10,0) DEFAULT NULL,
  `id_race` decimal(10,0) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `date_demande` date NOT NULL,
  `date_validation` date DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `criteres_supp` mediumtext,
  `reponse_demande` mediumtext,
  PRIMARY KEY (`id_demande`),
  UNIQUE KEY `id_demande` (`id_demande`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `id_duree`, `id_type_demande`, `id_statutTran`, `id_statutDem`, `id_profil`, `id_materiel`, `id_race`, `date_debut`, `date_fin`, `date_demande`, `date_validation`, `quantite`, `criteres_supp`, `reponse_demande`) VALUES
(32, '2', '2', '0', '1', '20', NULL, '9', '2021-05-20', '2022-05-20', '2022-05-18', NULL, 1, '', NULL),
(31, '3', '2', '0', '1', '20', NULL, '9', '2022-05-19', '2024-05-19', '2022-05-18', NULL, 1, '', NULL),
(29, '2', '2', '0', '1', '22', NULL, '3', '2022-05-11', '2023-05-11', '2022-05-18', NULL, 1, '', '<p> Nom : Dupont Jean-Claude exploitation : ferme de JC<br> tel : 0011223344 mail : jc@mail</p>'),
(30, '2', '2', '0', '1', '16', NULL, '11', '2022-05-19', '2023-05-19', '2022-05-18', NULL, 1, '', NULL),
(24, '2', '2', '0', '1', '17', NULL, '11', '2021-06-18', '2022-06-18', '2022-05-18', NULL, 1, '', NULL),
(26, '2', '2', '0', '1', '16', NULL, '11', '2019-03-07', '2020-03-07', '2022-05-18', NULL, 1, '', NULL),
(22, '2', '2', '0', '1', '12', NULL, '11', '2020-04-14', '2021-04-14', '2022-05-18', NULL, 1, '', NULL),
(21, '4', '1', NULL, '2', '12', '3', NULL, '2020-04-08', '2020-04-16', '2022-05-18', NULL, 1, '', NULL),
(20, '2', '2', '0', '1', '12', NULL, '11', '2020-05-13', '2021-05-13', '2022-05-18', NULL, 1, '', '<table><tr><td>1 animaux </td></tr> </table><br><br>');

-- --------------------------------------------------------

--
-- Structure de la table `docsanimaux`
--

DROP TABLE IF EXISTS `docsanimaux`;
CREATE TABLE IF NOT EXISTS `docsanimaux` (
  `id_doc_animal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_typeA` decimal(10,0) NOT NULL,
  `id_animal` decimal(10,0) NOT NULL,
  `emplacementA` varchar(254) NOT NULL,
  `lienA` mediumtext NOT NULL,
  PRIMARY KEY (`id_doc_animal`),
  UNIQUE KEY `id_doc_animal` (`id_doc_animal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `docsmateriel`
--

DROP TABLE IF EXISTS `docsmateriel`;
CREATE TABLE IF NOT EXISTS `docsmateriel` (
  `id_doc_mat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_typeM` decimal(10,0) NOT NULL,
  `id_materiel` decimal(10,0) NOT NULL,
  `emplacementM` varchar(254) NOT NULL,
  `lienM` mediumtext NOT NULL,
  PRIMARY KEY (`id_doc_mat`),
  UNIQUE KEY `id_doc_mat` (`id_doc_mat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `docsprofil`
--

DROP TABLE IF EXISTS `docsprofil`;
CREATE TABLE IF NOT EXISTS `docsprofil` (
  `id_doc_profil` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_profil` decimal(10,0) NOT NULL,
  `id_typeP` decimal(10,0) NOT NULL,
  `emplacementP` varchar(254) NOT NULL,
  `lienP` mediumtext NOT NULL,
  PRIMARY KEY (`id_doc_profil`),
  UNIQUE KEY `id_doc_profil` (`id_doc_profil`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `dureeconvention`
--

DROP TABLE IF EXISTS `dureeconvention`;
CREATE TABLE IF NOT EXISTS `dureeconvention` (
  `id_duree` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_duree` varchar(254) NOT NULL,
  PRIMARY KEY (`id_duree`),
  UNIQUE KEY `id_duree` (`id_duree`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dureeconvention`
--

INSERT INTO `dureeconvention` (`id_duree`, `lib_duree`) VALUES
(1, '6 mois'),
(2, '1 an'),
(3, '2 ans'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

DROP TABLE IF EXISTS `espece`;
CREATE TABLE IF NOT EXISTS `espece` (
  `id_espece` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `espece` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_espece`),
  UNIQUE KEY `id_espece` (`id_espece`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`id_espece`, `espece`) VALUES
(1, 'Bovin'),
(2, 'EquidÃ©'),
(3, 'Ovin'),
(4, 'Caprin'),
(5, 'Porcin'),
(6, 'Volaille'),
(7, 'Rongeur'),
(8, 'Insecte');

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `id_exploit` decimal(10,0) NOT NULL,
  `id_etape` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_demande` decimal(10,0) DEFAULT NULL,
  `date_fin_transport` date NOT NULL,
  `num_etape` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_etape`),
  UNIQUE KEY `id_etape` (`id_etape`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `exploitation`
--

DROP TABLE IF EXISTS `exploitation`;
CREATE TABLE IF NOT EXISTS `exploitation` (
  `id_exploit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_commune` decimal(10,0) NOT NULL,
  `nom_exploit` varchar(254) NOT NULL,
  `coordX` float DEFAULT NULL,
  `coordY` float DEFAULT NULL,
  `adresse` varchar(254) NOT NULL,
  `supplement_adresse` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_exploit`),
  UNIQUE KEY `id_exploit` (`id_exploit`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `exploitation`
--

INSERT INTO `exploitation` (`id_exploit`, `id_commune`, `nom_exploit`, `coordX`, `coordY`, `adresse`, `supplement_adresse`) VALUES
(15, '1', 'ferme de lee', -1.09941, 43.7948, '4 rue des hauts', ''),
(14, '1', 'ferme des hetres', -0.521533, 43.713, '', ''),
(13, '1', 'ferme des chenes', -0.822558, 44.0038, '13 rue des chenes', ''),
(12, '1', 'ferme des pins', -0.420459, 44.3402, '15 rue Joffre', ''),
(7, '1', 'Ferme des Charmes', -1.04518, 43.2364, 'rue des charmes', NULL),
(8, '1', 'ferme de Franck', NULL, NULL, '20 rue des pins', NULL),
(9, '2', 'ferme de JC', NULL, NULL, '30 rue des chenes', NULL),
(10, '1', 'Ferme soignon', 0.612, 44.773, 'rue des chevres', ''),
(11, '1', 'Ferme Cabecou', 0.627, 44.806, 'rue des brebis', '');

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

DROP TABLE IF EXISTS `famille`;
CREATE TABLE IF NOT EXISTS `famille` (
  `id_famille` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `famille` varchar(254) NOT NULL,
  PRIMARY KEY (`id_famille`),
  UNIQUE KEY `id_famille` (`id_famille`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`id_famille`, `famille`) VALUES
(1, 'Cousseau'),
(2, 'Musti'),
(3, 'PrimevÃ¨re'),
(4, 'Pigaille'),
(5, 'Eydie'),
(6, 'Medoquine'),
(7, 'Damiselle'),
(8, 'Astra'),
(9, 'Melinda'),
(10, 'Douce');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id_faq` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_typeFAQ` bigint(20) NOT NULL,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id_faq`),
  UNIQUE KEY `id_faq` (`id_faq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id_materiel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_conservatoire` varchar(15) NOT NULL,
  `id_type_mat` decimal(10,0) NOT NULL,
  `id_exploit` decimal(10,0) DEFAULT NULL,
  `lieu_stockage` int(11) DEFAULT NULL,
  `nom_materiel` varchar(254) DEFAULT NULL,
  `valeur_achat` float DEFAULT NULL,
  `annee_achat` int(4) DEFAULT NULL,
  `date_prochainControle` date DEFAULT NULL,
  `plaque` varchar(9) DEFAULT NULL,
  `quantite_ptitmat` int(11) DEFAULT NULL,
  `disponibilite` tinyint(1) DEFAULT NULL,
  `retour_depot` tinyint(1) DEFAULT NULL,
  `etat_des_lieux` tinyint(1) DEFAULT NULL,
  `commentaire_materiel` mediumtext,
  PRIMARY KEY (`id_materiel`),
  UNIQUE KEY `id_materiel` (`id_materiel`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id_materiel`, `id_conservatoire`, `id_type_mat`, `id_exploit`, `lieu_stockage`, `nom_materiel`, `valeur_achat`, `annee_achat`, `date_prochainControle`, `plaque`, `quantite_ptitmat`, `disponibilite`, `retour_depot`, `etat_des_lieux`, `commentaire_materiel`) VALUES
(1, 'CRA-1-01', '1', '1', NULL, 'Bétaillère', 2000, 2005, '2022-05-15', 'BG-335-NE', NULL, 1, NULL, NULL, 'Petit van'),
(2, 'CRA-1-02', '1', '2', NULL, 'Bétaillère', 3500, 2019, '2022-10-22', 'DE-480-QB', NULL, 1, NULL, NULL, 'Van'),
(3, 'CRA-1-03', '1', '3', NULL, 'Remorque bagagère Lider', NULL, NULL, NULL, 'FK-878-AN', NULL, 1, NULL, NULL, NULL),
(4, 'CRA-1-04', '1', NULL, 9, 'Remorque bagagère Soumat', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 'CRA-2-01', '2', NULL, 9, 'Parc de contention bovin', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6, 'CRA-2-02', '2', NULL, 9, 'Parc de contention ovin', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7, 'CRA-3-01', '3', '5', NULL, 'Petite couveuse', 150, 2021, NULL, NULL, NULL, 1, NULL, NULL, '< 30 oeufs'),
(8, 'CRA-3-02', '3', '5', NULL, 'Petite couveuse ', 150, 2021, NULL, NULL, NULL, 1, NULL, NULL, '< 30 oeufs'),
(9, 'CRA-3-03', '3', '5', NULL, 'Petite couveuse', 150, 2021, NULL, NULL, NULL, 1, NULL, NULL, '< 30 oeufs'),
(10, 'CRA-3-04', '3', '4', NULL, 'Moyenne couveuse', 250, 2021, NULL, NULL, NULL, 1, NULL, NULL, '< 60 oeufs'),
(11, 'CRA-3-05', '3', '4', NULL, 'Moyenne couveuse', 250, 2021, NULL, NULL, NULL, 1, NULL, NULL, '< 60 oeufs'),
(12, 'CRA-3-06', '3', '4', NULL, 'Grande couveuse', 400, 2021, NULL, NULL, NULL, 1, NULL, NULL, '> 100 oeufs'),
(13, 'CRA-3-07', '3', NULL, 9, 'Lampe chauffante', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(14, 'CRA-3-08', '3', NULL, 9, 'Eleveuse poussin', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(15, 'CRA-4-01 ', '4', NULL, 9, 'Lot de bâches/ kakémono des races d\'Aquitaine', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16, 'CRA-4-02', '4', NULL, 9, 'Lot de bâches/kakémono des races d’Aquitaine ', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(17, 'CRA-4-03', '4', NULL, 9, 'Lot de bâches/kakémono des races d’Aquitaine ', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(18, 'CRA-4-04 ', '4', NULL, 9, 'Kakémono de présentation du Conservatoire', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(19, 'CRA-4-05', '4', NULL, 9, 'Kakémono de présentation du Conservatoire', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(20, 'CRA-4-06 ', '4', NULL, 9, 'Lot de communication sur l’Abeille noire', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(21, 'CRA-4-07 ', '4', NULL, 9, 'Lot de matériel d’animation scolaire ', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(22, 'CRA-6-01  ', '6', NULL, 9, 'Petite caisse de transport ', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '(chien/agneaux/volailles) '),
(23, 'CRA-6-02  ', '6', NULL, 9, 'Grande caisse de transport ', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '(chien/agneaux/volailles)'),
(24, 'CRA-7-01', '7', NULL, 9, 'Compteur à lait', 250, NULL, NULL, NULL, NULL, 1, NULL, NULL, ''),
(25, 'CRA-7-02', '7', NULL, 9, 'Compteur à lait', 250, NULL, NULL, NULL, NULL, 1, NULL, NULL, ''),
(26, 'CRA-7-03', '7', NULL, NULL, 'Compteur à lait', 250, NULL, NULL, NULL, NULL, 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_photo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `emplacementPhotos` varchar(254) NOT NULL,
  `lien_photo` mediumtext NOT NULL,
  PRIMARY KEY (`id_photo`),
  UNIQUE KEY `id_photo` (`id_photo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id_profil` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_type_profil` decimal(10,0) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `identifiant_profil` varchar(254) DEFAULT NULL,
  `mdp` varchar(15) DEFAULT NULL,
  `consentement` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_profil`),
  UNIQUE KEY `id_profil` (`id_profil`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id_profil`, `id_type_profil`, `nom`, `prenom`, `identifiant_profil`, `mdp`, `consentement`) VALUES
(1, '1', 'Numag', 'Boss', 'numag1234', 'numag1234', 0),
(22, '2', 'Han', 'Bernard', 'bernard@mail', 'azerty', 1),
(21, '2', 'Chan', 'Chris', 'chris@mail', 'azerty', NULL),
(20, '2', 'Juston', 'Felix', 'felix@mail', 'azerty', NULL),
(19, '2', 'Soutin', 'Jean', 'jean@mail', 'azerty', NULL),
(12, '2', 'Bonnaud', 'Morgane', 'mbonnaud', 'azert', 1),
(16, '2', 'chevre', 'premier', 'prem@mail', 'azerty', NULL),
(14, '2', 'Schmit', 'Franck', 'franck@mail', 'azerty', NULL),
(15, '2', 'Dupont', 'Jean-Claude', 'jc@mail', 'azerty', 1),
(17, '2', 'chevres', 'deux', 'deux@mail', 'azerty', NULL),
(18, '1', 'Louca', 'Lucie', 'lucie@mail', 'aquitaine', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

DROP TABLE IF EXISTS `race`;
CREATE TABLE IF NOT EXISTS `race` (
  `id_race` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_espece` decimal(10,0) NOT NULL,
  `race` mediumtext,
  `prix_animal` text,
  PRIMARY KEY (`id_race`),
  UNIQUE KEY `id_race` (`id_race`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`id_race`, `id_espece`, `race`, `prix_animal`) VALUES
(1, '1', 'Vache Béarnaise', NULL),
(2, '1', 'Vache Bordelaise', NULL),
(3, '1', 'Vache Marine', NULL),
(4, '1', 'Vache Bazadaise', NULL),
(5, '1', 'Vache Betizu', NULL),
(6, '2', 'Poney Landais', NULL),
(7, '2', 'Poney Pottok', NULL),
(8, '2', 'Ã‚ne des PyrÃ©nÃ©es', NULL),
(9, '3', 'Mouton Landais', NULL),
(10, '3', 'Mouton Sasi Ardia', NULL),
(11, '4', 'ChÃ¨vre des PyrÃ©nÃ©es', NULL),
(12, '5', 'Porc Gascon', NULL),
(13, '5', 'Porc Basque', NULL),
(14, '6', 'Poule Gasconne', NULL),
(15, '6', 'Poule Landaise', NULL),
(16, '6', 'Dindon Gascon', NULL),
(17, '6', 'Canard Criard-Kriaxera', NULL),
(18, '7', 'Lapin ChÃ¨vre', NULL),
(19, '8', 'Abeille Noire du Pays-Basque', NULL),
(20, '8', 'Abeille Noire des Landes de Gascogne', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `id_sexe` char(1) NOT NULL,
  PRIMARY KEY (`id_sexe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id_sexe`) VALUES
('F'),
('H'),
('M');

-- --------------------------------------------------------

--
-- Structure de la table `statutdemande`
--

DROP TABLE IF EXISTS `statutdemande`;
CREATE TABLE IF NOT EXISTS `statutdemande` (
  `id_statutDem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Libelle_demande` varchar(20) NOT NULL,
  PRIMARY KEY (`id_statutDem`),
  UNIQUE KEY `id_statutDem` (`id_statutDem`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statutdemande`
--

INSERT INTO `statutdemande` (`id_statutDem`, `Libelle_demande`) VALUES
(1, 'valide'),
(2, 'en cours'),
(0, 'refuse');

-- --------------------------------------------------------

--
-- Structure de la table `statuttransport`
--

DROP TABLE IF EXISTS `statuttransport`;
CREATE TABLE IF NOT EXISTS `statuttransport` (
  `id_statutTran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_transport` varchar(20) NOT NULL,
  PRIMARY KEY (`id_statutTran`),
  UNIQUE KEY `id_statutTran` (`id_statutTran`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statuttransport`
--

INSERT INTO `statuttransport` (`id_statutTran`, `libelle_transport`) VALUES
(1, 'effectue'),
(0, 'pas effectue ');

-- --------------------------------------------------------

--
-- Structure de la table `textconvention`
--

DROP TABLE IF EXISTS `textconvention`;
CREATE TABLE IF NOT EXISTS `textconvention` (
  `id_bloc_convention` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_bloc` varchar(254) NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`id_bloc_convention`),
  UNIQUE KEY `id_bloc_convention` (`id_bloc_convention`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `textconvention`
--

INSERT INTO `textconvention` (`id_bloc_convention`, `lib_bloc`, `text`) VALUES
(2, 'page_consentement_1', 'Participation au programme de pr&eacute;servation de race et utilisation des donn&eacute;es d&rsquo;&eacute;levage\r\n\r\n'),
(4, 'page_consentement_2', 'D&eacute;claration de participation au programme de pr&eacute;servation et consentement d&rsquo;utilisation des donn&eacute;es d&rsquo;&eacute;levage pour de la race :  '),
(6, 'bloc_3', 'autorise les organismes suivants  : \r\nLe Conservatoire des races d&rsquo;Aquitaine, association reconnue d&rsquo;int&eacute;r&ecirc;t g&eacute;n&eacute;ral,'),
(7, 'bloc_4', '&agrave; collecter et &agrave; utiliser pour la gestion, la promotion, le d&eacute;veloppement et l&rsquo;&eacute;tude de la race les donn&eacute;es suivantes concernant mon &eacute;levage (*) : \n- coordonn&eacute;es administratives, identification du cheptel, mouvements des animaux\n- identification des animaux, parent&eacute; (g&eacute;n&eacute;alogie, analyses g&eacute;n&eacute;tiques), caract&eacute;ristiques morphologiques (photos, pointage) et g&eacute;n&eacute;tiques,\n- donn&eacute;es de reproduction et de production,\n\n &agrave; publier dans les inventaires de race, comptes rendus diffus&eacute;s aux &eacute;leveurs et acteurs de la race, sur tout support, les informations suivantes (*) :\n- nom et pr&eacute;nom, adresse, num&eacute;ro d&rsquo;exploitation, t&eacute;l&eacute;phone, mail\n- identification des animaux (nom, date de naissance, origines et g&eacute;n&eacute;alogie, type g&eacute;n&eacute;tique, caract&eacute;ristiques morphologiques, photos) \n- qualit&eacute; de naisseur pour les animaux ant&eacute;rieurement n&eacute;s chez moi\n\nCette autorisation d&rsquo;utilisation des donn&eacute;es d&rsquo;&eacute;levage est valable pour une dur&eacute;e illimit&eacute;e. \nJe peux la retirer ou la modifier &agrave; tout moment, sur simple demande de ma part.\nJe suis inform&eacute; que je dispose du droit d&rsquo;acc&egrave;s, d&rsquo;opposition, de modification ou de suppression des donn&eacute;es me concernant conform&eacute;ment aux dispositions de la Loi du 17 janvier 1978 relative &agrave; la protection des donn&eacute;es personnelles. Je peux  exercer ce droit par courrier aupr&egrave;s du Pr&eacute;sident du Conservatoire des Races d&#039;Aquitaine, 1 cours du G&eacute;n&eacute;ral de Gaulle, 33175 Gradignan. \n\nFait &agrave; &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;   le &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; Signature du propri&eacute;taire ou du repr&eacute;sentant l&eacute;gal avec mention &laquo; lu et approuv&eacute; &raquo; \n\n\n\n\nA retourner &agrave; : Conservatoire des Races d&rsquo;Aquitaine, 1 cours du G&eacute;n&eacute;ral de Gaulle 33175 Gradignan.\n\n(*): Vous pouvez choisir de rayer certaines mentions de la liste qui suit. '),
(5, 'bloc_2', 'Je soussign&eacute;, en cas de personne morale, noter le nom de la structure (GAEC, EARL, SCEA &hellip;) et le nom du repr&eacute;sentant d&eacute;sign&eacute;  &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;\r\nT&eacute;l&eacute;phone : Fixe &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; Mobile &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;  \r\nMail : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;   \r\nPropri&eacute;taire /d&eacute;tenteur d&rsquo;animaux de la race,  n&deg; d&rsquo;exploitation  FR| _ | _ | _ | _ | _ | _ | _ | _ |\r\n\r\nd&eacute;clare participer au programme de pr&eacute;servation de la race: '),
(3, 'bloc_1', 'En tant qu&rsquo;&eacute;leveur, vous contribuez &agrave; la pr&eacute;servation et au d&eacute;veloppement de  la race.\r\nLe programme de conservation de la race est suivi par le Conservatoire des races d&rsquo;Aquitaine accompagn&eacute; par diff&eacute;rentes associations\r\n\r\nDans le cadre de sa mission, le Conservatoire sera amen&eacute; &agrave; utiliser les donn&eacute;es d&rsquo;&eacute;levage que vous transmettez aux animateurs du Conservatoire et des associations en lien avec la race (voir page 2). La nouvelle r&eacute;glementation g&eacute;n&eacute;rale sur la protection des donn&eacute;es personnelles (RGPD du 25 mai 2018) n&eacute;cessite que vous ayez donn&eacute; pr&eacute;alablement votre accord pour traiter et publier ces informations (par ex. pour l&rsquo;inventaire des &eacute;levages). Avec votre accord, les donn&eacute;es pourront &ecirc;tre partag&eacute;es avec les organismes techniques et comp&eacute;tents (voir page 2) selon des r&egrave;gles d&eacute;finies par convention de partenariat.\r\n\r\nQuelles sont les informations utiles pour le programme de conservatoire ? \r\n-les donn&eacute;es administratives (nom, adresse, t&eacute;l&eacute;phone, mail, num&eacute;ro d&rsquo;exploitation)\r\n-les donn&eacute;es sur les animaux (identification, num&eacute;ros, description, type de g&eacute;n&eacute;tique, mouvements, photos, indicateurs)\r\n\r\nQui pouvez-vous autoriser &agrave; utiliser vos donn&eacute;es ? \r\nLe Conservatoire des Races d&#039;Aquitaine et les associations concern&eacute;es \r\nVotre accord peut &ecirc;tre modifi&eacute; ou retir&eacute; &agrave; tout moment.\r\n\r\nComment les donn&eacute;es seront-elles utilis&eacute;es ? \r\nLe Conservatoire int&eacute;grera ces informations dans le programme de conservation ce qui lui permettra d&rsquo;assurer:\r\n-le suivi  de race (d&eacute;mographie, g&eacute;n&eacute;alogie, g&eacute;n&eacute;tique, consanguinit&eacute;, performance),\r\n-le plan de reproduction,\r\n-l&rsquo;&eacute;valuation des animaux, \r\n-des &eacute;tudes sur la race,\r\n-le publications aupr&egrave;s des &eacute;leveurs et des utilisateurs de la race concern&eacute;e\r\nVotre participation et celle du plus grand nombre d&rsquo;&eacute;leveurs est importante : elle permettra de regrouper tous les param&egrave;tres de la race, d&rsquo;assurer une gestion globale et collective, et de construire une vision commune de l&rsquo;avenir de la race.  \r\n\r\nDe plus, en participant au programme de conservation de la race, vous pouvez :\r\n- faire reconna&icirc;tre vos animaux et les faire inscrire au livre g&eacute;n&eacute;alogique de la race, \r\n- recevoir des informations sur la race et le programme de conservation, des conseils sur les accouplements et l&rsquo;utilisation des m&acirc;les reproducteurs,\r\n- b&eacute;n&eacute;ficier des reproducteurs (se renseigner aupr&egrave;s du Conservatoire ). \r\n\r\nNous vous remercions de bien vouloir compl&eacute;ter et retourner l&rsquo;accord de consentement joint. \r\nRestant &agrave; votre disposition pour toute information compl&eacute;mentaire. Bien amicalement.\r\n\r\nPour le Conservatoire des Races d&rsquo;Aquitaine, \r\nR&eacute;gis Rib&eacute;reau-Gayon.\r\n'),
(1, 'titre_consentement', 'FICHE DE CONSENTEMENT '),
(8, 'racepdf', '3'),
(9, 'Conv_id_profil', '22'),
(10, 'Conv_identifiant_animal', 'FR 45,'),
(11, 'Conv_duree', '1 an');

-- --------------------------------------------------------

--
-- Structure de la table `typededemande`
--

DROP TABLE IF EXISTS `typededemande`;
CREATE TABLE IF NOT EXISTS `typededemande` (
  `id_type_demande` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_demande` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_type_demande`),
  UNIQUE KEY `id_type_demande` (`id_type_demande`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typededemande`
--

INSERT INTO `typededemande` (`id_type_demande`, `lib_demande`) VALUES
(1, 'Matériel'),
(2, 'Animal'),
(3, 'Troupeau');

-- --------------------------------------------------------

--
-- Structure de la table `typedemateriel`
--

DROP TABLE IF EXISTS `typedemateriel`;
CREATE TABLE IF NOT EXISTS `typedemateriel` (
  `id_type_mat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_materiel` varchar(254) NOT NULL,
  PRIMARY KEY (`id_type_mat`),
  UNIQUE KEY `id_type_mat` (`id_type_mat`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typedemateriel`
--

INSERT INTO `typedemateriel` (`id_type_mat`, `lib_materiel`) VALUES
(4, 'Support de communication'),
(3, 'Volaille'),
(2, 'Contention des animaux'),
(1, 'Remorque'),
(5, 'Apiculture'),
(6, 'Transports des animaux'),
(7, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `typedeprofil`
--

DROP TABLE IF EXISTS `typedeprofil`;
CREATE TABLE IF NOT EXISTS `typedeprofil` (
  `id_type_profil` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_droit` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_type_profil`),
  UNIQUE KEY `id_type_profil` (`id_type_profil`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typedeprofil`
--

INSERT INTO `typedeprofil` (`id_type_profil`, `lib_droit`) VALUES
(1, 'Admin'),
(2, 'Ã‰leveur'),
(3, 'Association');

-- --------------------------------------------------------

--
-- Structure de la table `typedocsanimaux`
--

DROP TABLE IF EXISTS `typedocsanimaux`;
CREATE TABLE IF NOT EXISTS `typedocsanimaux` (
  `id_typeA` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_docsA` varchar(254) NOT NULL,
  PRIMARY KEY (`id_typeA`),
  UNIQUE KEY `id_typeA` (`id_typeA`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typedocsanimaux`
--

INSERT INTO `typedocsanimaux` (`id_typeA`, `lib_docsA`) VALUES
(1, 'Fiche vÃ©to'),
(2, 'Convention'),
(3, 'Passeport');

-- --------------------------------------------------------

--
-- Structure de la table `typedocsmateriel`
--

DROP TABLE IF EXISTS `typedocsmateriel`;
CREATE TABLE IF NOT EXISTS `typedocsmateriel` (
  `id_typeM` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_docsM` varchar(254) NOT NULL,
  PRIMARY KEY (`id_typeM`),
  UNIQUE KEY `id_typeM` (`id_typeM`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typedocsmateriel`
--

INSERT INTO `typedocsmateriel` (`id_typeM`, `lib_docsM`) VALUES
(1, 'Etat des lieux'),
(2, 'Notice'),
(3, 'ContrÃ´le technique');

-- --------------------------------------------------------

--
-- Structure de la table `typedocsprofil`
--

DROP TABLE IF EXISTS `typedocsprofil`;
CREATE TABLE IF NOT EXISTS `typedocsprofil` (
  `id_typeP` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_docsP` varchar(254) NOT NULL,
  PRIMARY KEY (`id_typeP`),
  UNIQUE KEY `id_typeP` (`id_typeP`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typedocsprofil`
--

INSERT INTO `typedocsprofil` (`id_typeP`, `lib_docsP`) VALUES
(1, 'Permis'),
(2, 'Permis poids-lourd'),
(3, 'Consentement');

-- --------------------------------------------------------

--
-- Structure de la table `typef_a_q`
--

DROP TABLE IF EXISTS `typef_a_q`;
CREATE TABLE IF NOT EXISTS `typef_a_q` (
  `id_typeFAQ` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lib_FAQ` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id_typeFAQ`),
  UNIQUE KEY `id_typeFAQ` (`id_typeFAQ`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typef_a_q`
--

INSERT INTO `typef_a_q` (`id_typeFAQ`, `lib_FAQ`) VALUES
(1, 'AccÃ©der Ã  certaines informations'),
(2, 'Ajouter des animaux '),
(3, 'Faire une demande');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
