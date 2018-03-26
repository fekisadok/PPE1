-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 13 nov. 2017 à 12:41
-- Version du serveur :  5.6.34-log
-- Version de PHP :  7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `social_network`
--

-- --------------------------------------------------------

--
-- Structure de la table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(20) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `expires`, `user_id`, `token`) VALUES
(8, '<Ñü«ÙoÜ', '2017-12-08 17:45:47', 4, 'ca7b8492a6821a0ee72e305b17b97812164ec7bf457643d0c4ba03276e1bfd7b'),
(9, 'Ð²/¡•P5›', '2017-12-10 16:21:42', 4, 'bdb2bc3ced38b1a08b89b12890098c1b4c408ef7cf8e18c22ae3e5d8b56534ed');

-- --------------------------------------------------------

--
-- Structure de la table `friends_relationships`
--

CREATE TABLE `friends_relationships` (
  `user_id1` int(11) NOT NULL DEFAULT '0',
  `user_id2` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `friends_relationships`
--

INSERT INTO `friends_relationships` (`user_id1`, `user_id2`, `status`, `created_at`) VALUES
(1, 4, '1', '2017-11-02 17:18:00'),
(2, 4, '1', '2017-11-02 16:30:19'),
(3, 2, '1', '2017-11-02 15:31:30'),
(3, 4, '1', '2017-11-02 17:17:14'),
(4, 4, '2', '2017-11-02 21:18:30');

-- --------------------------------------------------------

--
-- Structure de la table `microposts`
--

CREATE TABLE `microposts` (
  `id` int(11) NOT NULL,
  `contenu` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `like_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `microposts`
--

INSERT INTO `microposts` (`id`, `contenu`, `user_id`, `created_at`, `like_count`) VALUES
(8, 'Ceci est un test !!', 1, '2017-11-02 11:56:34', 1),
(9, 'test profil sadok', 1, '2017-11-02 21:00:49', 1),
(11, 'test profil fekisadok', 4, '2017-11-02 22:10:27', 2);

-- --------------------------------------------------------

--
-- Structure de la table `micropost_like`
--

CREATE TABLE `micropost_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `micropost_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `micropost_like`
--

INSERT INTO `micropost_like` (`id`, `user_id`, `micropost_id`, `created_at`) VALUES
(1, 4, 9, '2017-11-02 22:07:31'),
(7, 1, 11, '2017-11-02 23:13:57'),
(9, 4, 8, '2017-11-03 09:53:04'),
(21, 4, 11, '2017-11-08 16:16:35');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `subject_id`, `name`, `user_id`, `created_at`, `seen`) VALUES
(1, 4, 'friend_request_sent', 2, '2017-11-02 16:30:19', '1'),
(2, 2, 'friend_request_accepted', 4, '2017-11-02 16:31:36', '1'),
(3, 4, 'friend_request_sent', 3, '2017-11-02 17:17:14', '1'),
(4, 4, 'friend_request_sent', 1, '2017-11-02 17:18:00', '1'),
(5, 1, 'friend_request_accepted', 4, '2017-11-02 20:59:51', '0'),
(6, 3, 'friend_request_accepted', 4, '2017-11-02 20:59:57', '0');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `civilite` enum('H','F') DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `code_compte` int(11) NOT NULL,
  `active` enum('0','1') DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `nom`, `prenom`, `civilite`, `date_naissance`, `ville`, `pays`, `code_compte`, `active`, `created_at`, `avatar`) VALUES
(1, 'sadok', 'fekisadok1109@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'feki', 'sadok', 'H', '1993-09-11', 'Montpellier', 'France', 0, '0', '2017-10-14 12:08:04', NULL),
(2, 'alexia', 'youssef.alexia@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Youssef', 'Alexia', 'H', '1970-01-01', 'Montpellier', NULL, 0, '0', '2017-10-14 12:09:19', NULL),
(3, 'alexia1', 'youssef.alexia1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'youssef', 'alexia', 'F', '1970-01-01', NULL, NULL, 0, '0', '2017-10-14 12:13:37', NULL),
(4, 'fekisadok', 'feki.sadok1109@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'feki', 'sadok', 'H', '1997-08-22', 'Montpellier', NULL, 0, '0', '2017-10-14 12:34:42', '/2eme_Annee/bootstrap-social-network-template-master\\bootstrap-social-network-template-master/uploads/4/94743fe8f70af56515b799763e18ae26.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`);

--
-- Index pour la table `friends_relationships`
--
ALTER TABLE `friends_relationships`
  ADD PRIMARY KEY (`user_id1`,`user_id2`),
  ADD KEY `user_id2` (`user_id2`);

--
-- Index pour la table `microposts`
--
ALTER TABLE `microposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `micropost_like`
--
ALTER TABLE `micropost_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `micropost_id` (`micropost_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `microposts`
--
ALTER TABLE `microposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `micropost_like`
--
ALTER TABLE `micropost_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `friends_relationships`
--
ALTER TABLE `friends_relationships`
  ADD CONSTRAINT `friends_relationships_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_relationships_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `microposts`
--
ALTER TABLE `microposts`
  ADD CONSTRAINT `microposts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `micropost_like`
--
ALTER TABLE `micropost_like`
  ADD CONSTRAINT `micropost_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `micropost_like_ibfk_2` FOREIGN KEY (`micropost_id`) REFERENCES `microposts` (`id`),
  ADD CONSTRAINT `micropost_like_ibfk_3` FOREIGN KEY (`micropost_id`) REFERENCES `microposts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `micropost_like_ibfk_4` FOREIGN KEY (`micropost_id`) REFERENCES `microposts` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
