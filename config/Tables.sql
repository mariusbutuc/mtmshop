-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 17 Avril 2009 à 00:24
-- Version du serveur: 5.1.30
-- Version de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `e_shopping`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `naissance` date NOT NULL,
  `login` varchar(10) NOT NULL,
  `motpasse` varchar(25) NOT NULL,
  `coord_banc` varchar(20) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `code_postal` tinyint(5) unsigned NOT NULL,
  `pays` varchar(25) NOT NULL,
  `ville` varchar(25) NOT NULL,
  `telephone` int(14) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `client`
--


-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_client` tinyint(5) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `montant` float unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commande`
--


-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

CREATE TABLE IF NOT EXISTS `commande_produit` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_comm` tinyint(5) unsigned NOT NULL,
  `id_prod` tinyint(5) unsigned NOT NULL,
  `quantite` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`id_prod`),
  KEY `id_comm` (`id_comm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commande_produit`
--


-- --------------------------------------------------------

--
-- Structure de la table `descriptif`
--

CREATE TABLE IF NOT EXISTS `descriptif` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `descriptif`
--


-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) NOT NULL,
  `prix` float NOT NULL,
  `unite_vente` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `produit`
--


-- --------------------------------------------------------

--
-- Structure de la table `produit_descriptif`
--

CREATE TABLE IF NOT EXISTS `produit_descriptif` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_prod` tinyint(5) unsigned NOT NULL,
  `id_desc` tinyint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`id_prod`),
  KEY `id_desc` (`id_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `produit_descriptif`
--


-- --------------------------------------------------------

--
-- Structure de la table `produit_propriete`
--

CREATE TABLE IF NOT EXISTS `produit_propriete` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_prod` tinyint(5) unsigned NOT NULL,
  `id_prop` tinyint(5) unsigned NOT NULL,
  `valeur_prop` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prop` (`id_prop`),
  KEY `id_prod` (`id_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `produit_propriete`
--


-- --------------------------------------------------------

--
-- Structure de la table `produit_rubrique`
--

CREATE TABLE IF NOT EXISTS `produit_rubrique` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_prod` tinyint(5) unsigned NOT NULL,
  `id_rubr` tinyint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`id_prod`),
  KEY `id_rubr` (`id_rubr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `produit_rubrique`
--


-- --------------------------------------------------------

--
-- Structure de la table `propriete`
--

CREATE TABLE IF NOT EXISTS `propriete` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `nom_2` (`nom`),
  UNIQUE KEY `nom_3` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `propriete`
--


-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE IF NOT EXISTS `rubrique` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `rubrique`
--


-- --------------------------------------------------------

--
-- Structure de la table `rubrique_superieure`
--

CREATE TABLE IF NOT EXISTS `rubrique_superieure` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rubr_fils` tinyint(5) unsigned NOT NULL,
  `id_rubr_pere` tinyint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rubr_fils` (`id_rubr_fils`),
  KEY `id_rubr_pere` (`id_rubr_pere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `rubrique_superieure`
--


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`id_comm`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_descriptif`
--
ALTER TABLE `produit_descriptif`
  ADD CONSTRAINT `produit_descriptif_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_descriptif_ibfk_2` FOREIGN KEY (`id_desc`) REFERENCES `descriptif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_propriete`
--
ALTER TABLE `produit_propriete`
  ADD CONSTRAINT `produit_propriete_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_propriete_ibfk_2` FOREIGN KEY (`id_prop`) REFERENCES `propriete` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit_rubrique`
--
ALTER TABLE `produit_rubrique`
  ADD CONSTRAINT `produit_rubrique_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_rubrique_ibfk_2` FOREIGN KEY (`id_rubr`) REFERENCES `rubrique` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rubrique_superieure`
--
ALTER TABLE `rubrique_superieure`
  ADD CONSTRAINT `rubrique_superieure_ibfk_1` FOREIGN KEY (`id_rubr_fils`) REFERENCES `rubrique` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rubrique_superieure_ibfk_2` FOREIGN KEY (`id_rubr_pere`) REFERENCES `rubrique` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
