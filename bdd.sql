-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 18 Décembre 2017 à 20:45
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ecvchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `channels`
--

CREATE TABLE `channels` (
  `ch_id` int(11) NOT NULL COMMENT 'identifiant du channel',
  `ch_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'nom du channel défini par un utilisateur',
  `ch_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'type du channel : prive - public',
  `ch_created` date NOT NULL COMMENT 'date de création du channel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des salons';

--
-- Contenu de la table `channels`
--

INSERT INTO `channels` (`ch_id`, `ch_name`, `ch_type`, `ch_created`) VALUES
(6, 'antoine charline', 'private', '2017-12-10'),
(7, 'antoine blandine', 'private', '2017-12-12'),
(8, 'design', 'public', '2017-12-16'),
(9, 'développement web', 'public', '0000-00-00'),
(12, ' etienne', 'private', '2018-12-17'),
(13, 'charline etienne', 'private', '2018-12-17'),
(14, 'la vie ! ', 'public', '2018-12-17');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `fr_id` int(11) NOT NULL COMMENT 'identifint de la relation',
  `fr_id_user_send` int(11) NOT NULL COMMENT 'identifiant de l''utilisateur qui a envoyé l''invitation',
  `fr_id_user_receiver` int(11) NOT NULL COMMENT 'id de l''utilisateur qui a reçu l''invitation',
  `fr_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'statut l''invitation : pending - accepted - refused'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des amitiés';

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`fr_id`, `fr_id_user_send`, `fr_id_user_receiver`, `fr_status`) VALUES
(1, 14, 31, 'accepted'),
(2, 31, 34, 'accepted'),
(3, 34, 14, 'accepted'),
(4, 31, 36, 'accepted'),
(5, 14, 36, 'refused');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `mb_id` int(11) NOT NULL COMMENT 'identifiant de la relation',
  `mb_id_user` int(11) NOT NULL COMMENT 'identifiant de l''utilisateur',
  `mb_id_channel` int(11) NOT NULL COMMENT 'identifiant du salon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des membres des salons';

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`mb_id`, `mb_id_user`, `mb_id_channel`) VALUES
(4, 31, 6),
(5, 14, 6),
(6, 31, 7),
(7, 34, 7);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL COMMENT 'identifiant de la relation',
  `msg_id_channel` int(11) NOT NULL COMMENT 'identifiant du channel sur lequel est posté le message',
  `msg_id_user` int(11) NOT NULL COMMENT 'identifiant de la personne qui a publié le message',
  `msg_content` text NOT NULL COMMENT 'contenu du message',
  `msg_date` varchar(5) NOT NULL COMMENT 'date d''envoi du message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table de messages';

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_id_channel`, `msg_id_user`, `msg_content`, `msg_date`) VALUES
(41, 8, 14, '<h2>Hello</h2>\n', '21474'),
(42, 8, 14, '<p>ça va ?</p>\n', '0'),
(43, 8, 14, '<p>rrr</p>\n', '0'),
(44, 8, 14, '<p>rrr</p>\n', '0'),
(45, 8, 14, '<p>zzz</p>\n', '14:54'),
(46, 8, 14, '<p>mesagge !!</p>\n', '14:56'),
(47, 8, 14, '<p>rrr</p>\n', '14:56'),
(48, 8, 14, '<p>eee</p>\n', '14:59'),
(49, 8, 14, '<p>ttttt</p>\n', '15:0'),
(50, 8, 14, '<p>eeee</p>\n', '15:27'),
(51, 8, 14, '<p>rrr</p>\n', '15:28'),
(52, 8, 14, '<p>rrr</p>\n', '15:28'),
(53, 8, 14, '<p>coucou antoie !</p>\n', '15:32'),
(54, 8, 14, '<p>coucou Antoine !</p>\n', '15:33'),
(55, 8, 31, '<h3>Saluuuut !</h3>\n', '15:33'),
(56, 9, 31, '<p>coucou dev web !!</p>\n', '17:49'),
(57, 8, 14, '<p>test connection non register</p>\n', '17:50'),
(58, 8, 14, '<p>mon message !</p>\n', '17:52'),
(59, 8, 14, '<p>un autre !</p>\n', '17:53'),
(60, 8, 14, '<p>opui ?</p>\n', '19:18'),
(61, 8, 14, '<p>t\'es la ?</p>\n', '19:22'),
(62, 8, 14, '<p>hellob  a a ca va</p>\n', '19:25'),
(63, 8, 14, '<p>hello</p>\n', '19 : '),
(64, 8, 14, '<p>t\'es la ?</p>\n', '19 : ');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `us_id` int(11) NOT NULL COMMENT 'identifiant de l''utilisateur',
  `us_pseudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'pseudo de l''utilisateur',
  `us_mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'mail unique de l''utilisateur',
  `us_mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'mdp de l''utilisateur',
  `us_avatar` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'url de la photo de profil de l''utilisateur',
  `us_socket_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'identifiant socket pour les notifications en temps réel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des utilisateurs';

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`us_id`, `us_pseudo`, `us_mail`, `us_mdp`, `us_avatar`, `us_socket_id`) VALUES
(14, 'charline', 'charline@gmail.com', '$2y$10$aa8GyVvUHdGIWY7rF8pXxeRV4tdFK67d414jEfs0udlKVZPxlzn7y', '', 'MgJ5VDt4NGc3zJxKAAAR'),
(31, 'antoine', 'antoine@gmail.com', '$2y$10$r1QisSDCeWUcyO7g2YeGr.1Q/1HQ81UWVtiVp9Co7KrPryFp41oVq', '', ''),
(34, 'blandine', 'blandine@gmail.com', '$2y$10$Zj1RkzhmDWkXqUGC7rhwOeEvTHPn8uoioiC6hBaiLotbqle.WU1fa', '', ''),
(35, 'domi', 'domi@gmail.com', 'd', '', ''),
(36, 'etienne', 'etienne@gmail.com', '$2y$10$uoQEptdsWuSDX.oDfWRpy.vCApY6ajb5YCJOJypVeADxyAsSn3SuK', '', 'e77D7iui7zsBYNFUAABh');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`ch_id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`fr_id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mb_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `channels`
--
ALTER TABLE `channels`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du channel', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `fr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifint de la relation', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `mb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la relation', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la relation', AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de l''utilisateur', AUTO_INCREMENT=37;
