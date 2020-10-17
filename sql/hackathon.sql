-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 17 oct. 2020 à 17:32
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hackathon`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idCommentaire` int(11) NOT NULL,
  `idStylo` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `dateCom` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `element`
--

CREATE TABLE `element` (
  `idElement` int(11) NOT NULL,
  `nomElement` varchar(40) NOT NULL,
  `question` text NOT NULL,
  `elementSuivant1` int(11) DEFAULT NULL COMMENT 'Element enfant de l''élément suivant',
  `elementSuivant2` int(11) DEFAULT NULL,
  `reponse1` varchar(100) NOT NULL,
  `reponse2` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `element`
--

INSERT INTO `element` (`idElement`, `nomElement`, `question`, `elementSuivant1`, `elementSuivant2`, `reponse1`, `reponse2`) VALUES
(1, 'verrouSecu', 'Est-ce qu\'il y aura un verrou de sécurité ?', 5, 5, 'oui', 'non'),
(5, 'siteInjection', 'Peut-on appliquer le stylo auto-injecteur partout sur le corps, ou sur une zone déterminée ?', 6, 6, 'Multiple', 'Unique'),
(6, 'precision', 'Quel est la précision d\'injection du stylo ?', 7, 8, 'Précis', 'Libre'),
(7, 'sensibilite', 'Quelle est la forme de la base ?', 8, 8, 'Base large', 'Base fine'),
(8, 'symetrique', 'L\'appareil sera-t-il symétrique ?', NULL, NULL, 'oui', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `elementerreur`
--

CREATE TABLE `elementerreur` (
  `idElement` int(11) NOT NULL,
  `idErrreur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `elementerreur`
--

INSERT INTO `elementerreur` (`idElement`, `idErrreur`) VALUES
(8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `erreur`
--

CREATE TABLE `erreur` (
  `idErreur` int(11) NOT NULL,
  `textErreur` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `erreur`
--

INSERT INTO `erreur` (`idErreur`, `textErreur`) VALUES
(1, 'symétrique : Certains utilisateurs du stylo ont confondu les 2 embouts (aiguille et manche).');

-- --------------------------------------------------------

--
-- Structure de la table `stylo`
--

CREATE TABLE `stylo` (
  `idStylo` int(11) NOT NULL,
  `appelation` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `styloerreur`
--

CREATE TABLE `styloerreur` (
  `idStylo` int(11) DEFAULT NULL,
  `idErrreur` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `typeUtilisateur` enum('utilisateur','professionnel_sante','concepteur') NOT NULL,
  `mail` varchar(40) NOT NULL COMMENT 'fait office de login',
  `mdp_crypte` text NOT NULL,
  `pays` enum('France','Belgique','Suisse','Canada (Québec)') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `typeUtilisateur`, `mail`, `mdp_crypte`, `pays`) VALUES
(1, 'utilisateur', 'jean.dupont@test.test', '5f4dcc3b5aa765d61d8327deb882cf99', 'France');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `fk_stylo_id` (`idStylo`),
  ADD KEY `fk_utilisateur_id` (`idUtilisateur`);

--
-- Index pour la table `element`
--
ALTER TABLE `element`
  ADD PRIMARY KEY (`idElement`),
  ADD KEY `fk_elementSuivant2` (`elementSuivant2`),
  ADD KEY `fk_elementSuivant1` (`elementSuivant1`) USING BTREE;

--
-- Index pour la table `elementerreur`
--
ALTER TABLE `elementerreur`
  ADD KEY `fk_element_id` (`idElement`),
  ADD KEY `fk_erreur_id` (`idErrreur`);

--
-- Index pour la table `erreur`
--
ALTER TABLE `erreur`
  ADD PRIMARY KEY (`idErreur`);

--
-- Index pour la table `stylo`
--
ALTER TABLE `stylo`
  ADD PRIMARY KEY (`idStylo`);

--
-- Index pour la table `styloerreur`
--
ALTER TABLE `styloerreur`
  ADD KEY `fk_stylo_id` (`idStylo`),
  ADD KEY `fk_erreur_id` (`idErrreur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `element`
--
ALTER TABLE `element`
  MODIFY `idElement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `erreur`
--
ALTER TABLE `erreur`
  MODIFY `idErreur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `stylo`
--
ALTER TABLE `stylo`
  MODIFY `idStylo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
