-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 08:05 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ujn-esystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `access_level` varchar(200) NOT NULL,
  `fonction` varchar(30) NOT NULL,
  `control_finance` varchar(1) NOT NULL,
  `control_comptes` varchar(1) NOT NULL,
  `control_normal` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_time`
--

CREATE TABLE IF NOT EXISTS `attendance_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure_entree_min` varchar(20) NOT NULL,
  `heure_entree_max` varchar(20) NOT NULL,
  `heure_sortie_min` varchar(20) NOT NULL,
  `heure_sortie_max` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `attendance_time`
--

INSERT INTO `attendance_time` (`id`, `heure_entree_min`, `heure_entree_max`, `heure_sortie_min`, `heure_sortie_max`) VALUES
(1, '06:50', '07:40', '12:30', '13:00');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmod`
--

CREATE TABLE IF NOT EXISTS `paymentmod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(15) NOT NULL,
  `frais_scolaires` varchar(15) NOT NULL DEFAULT '0',
  `frais_construction` varchar(15) NOT NULL DEFAULT '0',
  `frais_bibliotheque` varchar(15) NOT NULL DEFAULT '0',
  `frais_cantine` varchar(15) NOT NULL DEFAULT '0',
  `frais_transport` varchar(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `paymentmod`
--

INSERT INTO `paymentmod` (`id`, `classe`, `frais_scolaires`, `frais_construction`, `frais_bibliotheque`, `frais_cantine`, `frais_transport`) VALUES
(2, '1ereA', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payment_maxfee`
--

CREATE TABLE IF NOT EXISTS `payment_maxfee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(15) NOT NULL,
  `frais_scolaires` varchar(15) NOT NULL DEFAULT '0',
  `frais_construction` varchar(15) NOT NULL DEFAULT '0',
  `frais_bibliotheque` varchar(15) NOT NULL DEFAULT '0',
  `frais_cantine` varchar(15) NOT NULL DEFAULT '0',
  `frais_transport` varchar(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `classe` (`classe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `payment_maxfee`
--

INSERT INTO `payment_maxfee` (`id`, `classe`, `frais_scolaires`, `frais_construction`, `frais_bibliotheque`, `frais_cantine`, `frais_transport`) VALUES
(13, '1ereA', '224.5', '30', '15', '10', '20');

-- --------------------------------------------------------

--
-- Table structure for table `payment_process`
--

CREATE TABLE IF NOT EXISTS `payment_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slip_id` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `numero_id` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `postnom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `classe` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `montant_verse` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `motif` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `dateheure` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `verse_par` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `receptionne_par` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `date` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'December 25, 2020',
  UNIQUE KEY `slip_id` (`slip_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE IF NOT EXISTS `staff_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_id` varchar(14) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `today_date` varchar(30) NOT NULL,
  `presence_avant` varchar(20) NOT NULL,
  `presence_apres` varchar(20) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'assets/images/faces/avatar.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `students_payments`
--

CREATE TABLE IF NOT EXISTS `students_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_id` varchar(14) COLLATE utf8mb4_swedish_ci NOT NULL,
  `frais_scolaires` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_construction` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_bibliotheque` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_cantine` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_transport` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  UNIQUE KEY `numero_id` (`numero_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE IF NOT EXISTS `student_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(200) NOT NULL DEFAULT 'assets/images/faces/avatar.png',
  `numero_id` varchar(14) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `sexe` varchar(15) NOT NULL,
  `classe` varchar(15) NOT NULL,
  `section` varchar(30) NOT NULL,
  `today_date` varchar(30) NOT NULL,
  `presence_avant` varchar(20) NOT NULL,
  `presence_apres` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ujnagents`
--

CREATE TABLE IF NOT EXISTS `ujnagents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_id` varchar(14) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `post_nom` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `fonction` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `sexe` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'assets/images/faces/avatar.png',
  `normal_access` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'active' COMMENT 'block the user at all',
  `checkstate_comptes` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'inactive',
  `checkstate_finances` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'inactive',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `numero_id` (`numero_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ujnagents`
--

INSERT INTO `ujnagents` (`id`, `numero_id`, `nom`, `post_nom`, `prenom`, `fonction`, `sexe`, `telephone`, `email`, `adress`, `photo`, `normal_access`, `checkstate_comptes`, `checkstate_finances`) VALUES
(7, '00000000000000', 'ujn-admin', 'electronic', 'system', 'admin', 'Masculin', '0992233445', 'admin@esystem.com', 'Goma/DRC', 'assets/images/faces/avatar.png', 'active', 'active', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ujnstudents`
--

CREATE TABLE IF NOT EXISTS `ujnstudents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_id` varchar(14) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `post_nom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `photo_eleve` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'assets/images/faces/avatar.png',
  `classe` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `section` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `sexe` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `date_naissance` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `lieu_naissance` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nom_pere` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nom_mere` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telephone_parent` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email_parents` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nom_enseignant` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `details_sanitaires` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'active',
  `photo` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `inscription` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`numero_id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `last_login`) VALUES
(7, 'admin@esystem.com', '$2y$10$WG7Zvc/ShXINAD5BvpJvHOC0bPAe7rwAcUk5ed43YDA3PP7ipJGoC', '2020-12-26 08:53:21', '2020-12-26 07:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_actionlogs`
--

CREATE TABLE IF NOT EXISTS `user_actionlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `dateheure` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `trans_id` (`trans_id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=16 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
