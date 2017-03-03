-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Mars 2017 à 09:37
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
  `id_next_turn_player` int(11) NOT NULL,
  `id_supermorpion` int(11) NOT NULL,
  PRIMARY KEY (`id_game`),
  KEY `id_player_1` (`id_player_1`,`id_player_2`,`id_next_turn_player`),
  KEY `id_player_2` (`id_player_2`),
  KEY `id_next_turn_player` (`id_next_turn_player`),
  KEY `id_supermorpion` (`id_supermorpion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_4` FOREIGN KEY (`id_supermorpion`) REFERENCES `supermorpion` (`id_supermorpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`id_player_1`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`id_player_2`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`id_next_turn_player`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `supermorpion`
--
ALTER TABLE `supermorpion`
  ADD CONSTRAINT `supermorpion_ibfk_9` FOREIGN KEY (`id_C3`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_1` FOREIGN KEY (`id_A1`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_2` FOREIGN KEY (`id_A2`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_3` FOREIGN KEY (`id_A3`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_4` FOREIGN KEY (`id_B1`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_5` FOREIGN KEY (`id_B2`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_6` FOREIGN KEY (`id_B3`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_7` FOREIGN KEY (`id_C1`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `supermorpion_ibfk_8` FOREIGN KEY (`id_C2`) REFERENCES `morpion` (`id_morpion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
