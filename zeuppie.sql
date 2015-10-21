-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 21 Octobre 2015 à 15:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `zeuppie`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id_administrateurs` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  PRIMARY KEY (`id_administrateurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id_administrateurs`, `id_utilisateurs`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id_articles` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  `id_categories` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `date_articles` datetime NOT NULL,
  PRIMARY KEY (`id_articles`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id_articles`, `id_utilisateurs`, `id_categories`, `titre`, `contenu`, `status`, `date_articles`) VALUES
(37, 4, 1, 'Article', '<p>\r\n	<img alt="" src="http://mp1st.com/wp-content/uploads/2012/07/call_of_duty_elite.jpg" style="height:370px; width:660px">\r\n</p>\r\n\r\n<p>\r\n	BlablaBlablaBlablaBlablaBlablaBlablaBlablaBlabla&nbsp;BlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlabla&nbsp;BlablaBlablaBlablaBlablaBlablaBlabla\r\n</p>\r\n', 1, '2015-09-25 03:43:28'),
(49, 4, 2, 'Article', '<p>\r\n	<img alt="" src="http://mp1st.com/wp-content/uploads/2012/07/call_of_duty_elite.jpg" style="height:370px; width:660px">\r\n</p>\r\n\r\n<p>\r\n	BlablaBlablaBlablaBlablaBlablaBlablaBlablaBlabla&nbsp;BlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlabla&nbsp;BlablaBlablaBlablaBlablaBlablaBlabla\r\n</p>\r\n', 1, '2015-09-25 03:43:28'),
(50, 4, 4, 'Article', '<p>\r\n	<img alt="" src="http://mp1st.com/wp-content/uploads/2012/07/call_of_duty_elite.jpg" style="height:370px; width:660px">\r\n</p>\r\n\r\n<p>\r\n	BlablaBlablaBlablaBlablaBlablaBlablaBlablaBlabla&nbsp;BlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlablaBlabla&nbsp;BlablaBlablaBlablaBlablaBlablaBlabla\r\n</p>\r\n', 1, '2015-09-25 03:43:28');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_categories` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categories` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_categories`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categories`, `nom_categories`, `status`) VALUES
(1, 'Informatique', 1),
(2, 'Science', 1),
(4, 'Autre', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaires` int(11) NOT NULL AUTO_INCREMENT,
  `id_articles_commentaires` int(11) NOT NULL,
  `id_utilisateurs_commentaires` int(11) NOT NULL,
  `message_commentaires` longtext NOT NULL,
  `date_commentaires` datetime NOT NULL,
  `active_commentaires` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaires`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaires`, `id_articles_commentaires`, `id_utilisateurs_commentaires`, `message_commentaires`, `date_commentaires`, `active_commentaires`) VALUES
(7, 37, 4, 'Nul a chier !!!', '2015-09-25 15:46:52', 1),
(8, 37, 4, 'Vraiment très nul. berk.', '2015-09-25 15:46:59', 1),
(9, 37, 4, '&lt;script&gt;alert(\\''Hello\\'');&lt;/script&gt;', '2015-09-25 17:12:53', 1),
(12, 37, 4, '''', '2015-10-21 02:48:17', 1),
(14, 49, 4, 'fsdf', '2015-10-21 04:38:53', 1),
(15, 49, 4, 'gdfgf', '2015-10-21 04:38:56', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notifications` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_notifications` datetime NOT NULL,
  PRIMARY KEY (`id_notifications`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id_notifications`, `id_utilisateurs`, `message`, `date_notifications`) VALUES
(1, 4, 'Bienvenue sur Zeuppie !', '2015-07-15 09:31:31');

-- --------------------------------------------------------

--
-- Structure de la table `profil_utilisateurs`
--

CREATE TABLE IF NOT EXISTS `profil_utilisateurs` (
  `id_profil_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `interet` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  PRIMARY KEY (`id_profil_utilisateurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `profil_utilisateurs`
--

INSERT INTO `profil_utilisateurs` (`id_profil_utilisateurs`, `id_utilisateurs`, `prenom`, `nom`, `age`, `pays`, `interet`, `description`, `twitter`, `facebook`, `google`) VALUES
(1, 4, 'Kevin', 'Lacroix', '45', 'France', 'informatique,science,developpement,sport', 'J''aime le sport et l''informatique ainsi que les sciences, je suis un passionné, bla bla bla', 'bigou', 'bigou.eifo', '4545455784512');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_roles` int(11) NOT NULL AUTO_INCREMENT,
  `nom_roles` varchar(255) NOT NULL,
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id_roles`, `nom_roles`) VALUES
(1, 'Rédacteur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL,
  PRIMARY KEY (`id_utilisateurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `login`, `password`, `pseudo`, `status`, `salt`, `role`, `date_inscription`) VALUES
(4, 'zim@zim.com', '$2y$08$PezOEdkEx781Zopedl309Oc3XuVOOTf7U51/Vw4rvBfnZmrCI9n.6', 'Zim', 1, '', '0', '2015-07-23 14:00:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
