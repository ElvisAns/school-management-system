-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 fév. 2022 à 07:46
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ujn-esystem`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
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
-- Structure de la table `attendance_time`
--

CREATE TABLE `attendance_time` (
  `id` int(11) NOT NULL,
  `heure_entree_min` varchar(20) NOT NULL,
  `heure_entree_max` varchar(20) NOT NULL,
  `heure_sortie_min` varchar(20) NOT NULL,
  `heure_sortie_max` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `attendance_time`
--

INSERT INTO `attendance_time` (`id`, `heure_entree_min`, `heure_entree_max`, `heure_sortie_min`, `heure_sortie_max`) VALUES
(1, '06:50', '07:40', '12:30', '13:00');

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `paymentmod`
--

CREATE TABLE `paymentmod` (
  `id` int(11) NOT NULL,
  `classe` varchar(15) NOT NULL,
  `frais_scolaires` varchar(15) NOT NULL DEFAULT '0',
  `frais_construction` varchar(15) NOT NULL DEFAULT '0',
  `frais_bibliotheque` varchar(15) NOT NULL DEFAULT '0',
  `frais_cantine` varchar(15) NOT NULL DEFAULT '0',
  `frais_transport` varchar(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paymentmod`
--

INSERT INTO `paymentmod` (`id`, `classe`, `frais_scolaires`, `frais_construction`, `frais_bibliotheque`, `frais_cantine`, `frais_transport`) VALUES
(2, '1ereA', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Structure de la table `payment_maxfee`
--

CREATE TABLE `payment_maxfee` (
  `id` int(11) NOT NULL,
  `classe` varchar(15) NOT NULL,
  `frais_scolaires` varchar(15) NOT NULL DEFAULT '0',
  `frais_construction` varchar(15) NOT NULL DEFAULT '0',
  `frais_bibliotheque` varchar(15) NOT NULL DEFAULT '0',
  `frais_cantine` varchar(15) NOT NULL DEFAULT '0',
  `frais_transport` varchar(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `payment_maxfee`
--

INSERT INTO `payment_maxfee` (`id`, `classe`, `frais_scolaires`, `frais_construction`, `frais_bibliotheque`, `frais_cantine`, `frais_transport`) VALUES
(13, '1ereA', '224.5', '30', '15', '10', '20');

-- --------------------------------------------------------

--
-- Structure de la table `payment_process`
--

CREATE TABLE `payment_process` (
  `id` int(11) NOT NULL,
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
  `date` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'December 25, 2020'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `numero_id` varchar(14) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `today_date` varchar(30) NOT NULL,
  `presence_avant` varchar(20) NOT NULL,
  `presence_apres` varchar(20) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'assets/images/faces/avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `students_payments`
--

CREATE TABLE `students_payments` (
  `id` int(11) NOT NULL,
  `numero_id` varchar(14) COLLATE utf8mb4_swedish_ci NOT NULL,
  `frais_scolaires` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_construction` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_bibliotheque` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_cantine` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0',
  `frais_transport` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'assets/images/faces/avatar.png',
  `numero_id` varchar(14) NOT NULL,
  `noms` varchar(50) NOT NULL,
  `sexe` varchar(15) NOT NULL,
  `classe` varchar(15) NOT NULL,
  `section` varchar(30) NOT NULL,
  `today_date` varchar(30) NOT NULL,
  `presence_avant` varchar(20) NOT NULL,
  `presence_apres` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ujnagents`
--

CREATE TABLE `ujnagents` (
  `id` int(11) NOT NULL,
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
  `checkstate_finances` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Déchargement des données de la table `ujnagents`
--

INSERT INTO `ujnagents` (`id`, `numero_id`, `nom`, `post_nom`, `prenom`, `fonction`, `sexe`, `telephone`, `email`, `adress`, `photo`, `normal_access`, `checkstate_comptes`, `checkstate_finances`) VALUES
(7, '00000000000000', 'ujn-admin', 'electronic', 'system', 'admin', 'Masculin', '0992233445', 'admin@esystem.com', 'Goma/DRC', 'assets/images/faces/avatar.png', 'active', 'active', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `ujnstudents`
--

CREATE TABLE `ujnstudents` (
  `id` int(11) NOT NULL,
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
  `inscription` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `last_login`) VALUES
(7, 'admin@esystem.com', '$2y$10$WG7Zvc/ShXINAD5BvpJvHOC0bPAe7rwAcUk5ed43YDA3PP7ipJGoC', '2020-12-26 08:53:21', '2022-02-09 02:58:31');

-- --------------------------------------------------------

--
-- Structure de la table `user_actionlogs`
--

CREATE TABLE `user_actionlogs` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `dateheure` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attendance_time`
--
ALTER TABLE `attendance_time`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Index pour la table `paymentmod`
--
ALTER TABLE `paymentmod`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payment_maxfee`
--
ALTER TABLE `payment_maxfee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classe` (`classe`);

--
-- Index pour la table `payment_process`
--
ALTER TABLE `payment_process`
  ADD UNIQUE KEY `slip_id` (`slip_id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `students_payments`
--
ALTER TABLE `students_payments`
  ADD UNIQUE KEY `numero_id` (`numero_id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `ujnagents`
--
ALTER TABLE `ujnagents`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `ujnstudents`
--
ALTER TABLE `ujnstudents`
  ADD UNIQUE KEY `id` (`id`,`numero_id`),
  ADD KEY `id_2` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_actionlogs`
--
ALTER TABLE `user_actionlogs`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attendance_time`
--
ALTER TABLE `attendance_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `paymentmod`
--
ALTER TABLE `paymentmod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `payment_maxfee`
--
ALTER TABLE `payment_maxfee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `payment_process`
--
ALTER TABLE `payment_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `students_payments`
--
ALTER TABLE `students_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ujnagents`
--
ALTER TABLE `ujnagents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ujnstudents`
--
ALTER TABLE `ujnstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user_actionlogs`
--
ALTER TABLE `user_actionlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
