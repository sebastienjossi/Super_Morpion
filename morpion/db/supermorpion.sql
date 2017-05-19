-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 19 Mai 2017 à 08:07
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `supermorpion`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id_game` int(11) NOT NULL AUTO_INCREMENT,
  `id_player_1` int(11) NOT NULL,
  `id_player_2` int(11) NOT NULL,
  `id_next_turn_player` int(11) DEFAULT NULL,
  `id_winner` int(11) DEFAULT NULL,
  `id_supermorpion` int(11) NOT NULL,
  PRIMARY KEY (`id_game`),
  KEY `id_player_1` (`id_player_1`,`id_player_2`,`id_next_turn_player`),
  KEY `id_player_2` (`id_player_2`),
  KEY `id_next_turn_player` (`id_next_turn_player`),
  KEY `id_supermorpion` (`id_supermorpion`),
  KEY `id_winner` (`id_winner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id_game`, `id_player_1`, `id_player_2`, `id_next_turn_player`, `id_winner`, `id_supermorpion`) VALUES
(48, 1, 2, 1, NULL, 2),
(50, 3, 1, 2, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `morpion`
--

CREATE TABLE IF NOT EXISTS `morpion` (
  `id_morpion` int(11) NOT NULL AUTO_INCREMENT,
  `A1` int(2) NOT NULL DEFAULT '0' COMMENT '0 = vide, 1 = croix et 2 = rond',
  `A2` int(2) NOT NULL DEFAULT '0',
  `A3` int(2) NOT NULL DEFAULT '0',
  `B1` int(2) NOT NULL DEFAULT '0',
  `B2` int(2) NOT NULL DEFAULT '0',
  `B3` int(2) NOT NULL DEFAULT '0',
  `C1` int(2) NOT NULL DEFAULT '0',
  `C2` int(2) NOT NULL DEFAULT '0',
  `C3` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_morpion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Contenu de la table `morpion`
--

INSERT INTO `morpion` (`id_morpion`, `A1`, `A2`, `A3`, `B1`, `B2`, `B3`, `C1`, `C2`, `C3`) VALUES
(1, 0, 2, 1, 2, 0, 1, 0, 2, 0),
(2, 2, 2, 2, 0, 0, 0, 0, 1, 1),
(3, 2, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 1, 0, 2, 1),
(6, 1, 0, 0, 0, 0, 0, 2, 1, 1),
(7, 0, 0, 2, 2, 2, 0, 2, 1, 0),
(8, 0, 2, 2, 2, 0, 2, 0, 0, 0),
(9, 0, 0, 2, 0, 1, 0, 1, 0, 2),
(10, 0, 2, 1, 2, 0, 0, 0, 0, 0),
(11, 0, 2, 2, 0, 0, 2, 0, 0, 0),
(12, 1, 1, 1, 0, 0, 0, 0, 0, 0),
(13, 1, 0, 0, 2, 2, 0, 0, 1, 1),
(14, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(31, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(32, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(33, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(34, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(35, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(36, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(37, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(41, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(50, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(52, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(59, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(60, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(62, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(63, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(64, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(67, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(68, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(69, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(70, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(71, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(72, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(73, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(74, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(77, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(80, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(89, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(90, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(91, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(92, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(93, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(94, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(95, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(96, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(97, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(98, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(99, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(101, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(102, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(103, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `supermorpion`
--

CREATE TABLE IF NOT EXISTS `supermorpion` (
  `id_supermorpion` int(11) NOT NULL AUTO_INCREMENT,
  `id_A1` int(11) NOT NULL,
  `id_A2` int(11) NOT NULL,
  `id_A3` int(11) NOT NULL,
  `id_B1` int(11) NOT NULL,
  `id_B2` int(11) NOT NULL,
  `id_B3` int(11) NOT NULL,
  `id_C1` int(11) NOT NULL,
  `id_C2` int(11) NOT NULL,
  `id_C3` int(11) NOT NULL,
  `pos_next_morpion` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id_supermorpion`),
  KEY `id_A1` (`id_A1`,`id_A2`,`id_A3`,`id_B1`,`id_B2`,`id_B3`,`id_C1`,`id_C2`,`id_C3`),
  KEY `id_A2` (`id_A2`),
  KEY `id_A3` (`id_A3`),
  KEY `id_B1` (`id_B1`),
  KEY `id_B2` (`id_B2`),
  KEY `id_B3` (`id_B3`),
  KEY `id_C1` (`id_C1`),
  KEY `id_C2` (`id_C2`),
  KEY `id_C3` (`id_C3`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `supermorpion`
--

INSERT INTO `supermorpion` (`id_supermorpion`, `id_A1`, `id_A2`, `id_A3`, `id_B1`, `id_B2`, `id_B3`, `id_C1`, `id_C2`, `id_C3`, `pos_next_morpion`) VALUES
(2, 5, 6, 7, 8, 9, 10, 11, 12, 13, NULL),
(3, 14, 15, 16, 17, 18, 19, 20, 21, 22, NULL),
(4, 23, 24, 25, 26, 27, 28, 29, 30, 31, NULL),
(5, 32, 33, 34, 35, 37, 39, 41, 43, 46, NULL),
(6, 36, 38, 40, 42, 45, 48, 50, 53, 55, NULL),
(7, 44, 47, 49, 51, 54, 57, 59, 62, 67, NULL),
(8, 52, 56, 58, 61, 65, 69, 73, 77, 81, NULL),
(9, 60, 63, 66, 70, 75, 79, 83, 87, 91, NULL),
(10, 64, 68, 71, 74, 78, 82, 86, 90, 93, NULL),
(11, 72, 76, 80, 84, 89, 94, 97, 99, 101, NULL),
(12, 85, 88, 92, 95, 96, 98, 100, 102, 103, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`) VALUES
(1, 'Coco', 'coco@coco.coco', 'coco'),
(2, 'Titi', 'titi@titi.titi', 'titi'),
(3, 'Ouioui', '1234', 'oui@oui.oui'),
(4, 'Sven', '12345', 'svenwikberg@gmail.com');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`id_player_1`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`id_player_2`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`id_next_turn_player`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_4` FOREIGN KEY (`id_supermorpion`) REFERENCES `supermorpion` (`id_supermorpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_5` FOREIGN KEY (`id_winner`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `supermorpion`
--
ALTER TABLE `supermorpion`
  ADD CONSTRAINT `supermorpion_ibfk_1` FOREIGN KEY (`id_A1`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_2` FOREIGN KEY (`id_A2`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_3` FOREIGN KEY (`id_A3`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_4` FOREIGN KEY (`id_B1`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_5` FOREIGN KEY (`id_B2`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_6` FOREIGN KEY (`id_B3`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_7` FOREIGN KEY (`id_C1`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_8` FOREIGN KEY (`id_C2`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_9` FOREIGN KEY (`id_C3`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
