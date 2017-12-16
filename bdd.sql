-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Sam 16 Décembre 2017 à 18:47
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

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `mb_id` int(11) NOT NULL COMMENT 'identifiant de la relation',
  `mb_id_user` int(11) NOT NULL COMMENT 'identifiant de l''utilisateur',
  `mb_id_channel` int(11) NOT NULL COMMENT 'identifiant du salon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des membres des salons';

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL COMMENT 'identifiant de la relation',
  `msg_id_channel` int(11) NOT NULL COMMENT 'identifiant du channel sur lequel est posté le message',
  `msg_id_user` int(11) NOT NULL COMMENT 'identifiant de la personne qui a publié le message',
  `msg_content` text NOT NULL COMMENT 'contenu du message',
  `msg_date` date NOT NULL COMMENT 'date d''envoi du message'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table de messages';

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `us_id` int(11) NOT NULL COMMENT 'identifiant de l''utilisateur',
  `us_pseudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'pseudo de l''utilisateur',
  `us_mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'mail unique de l''utilisateur',
  `us_mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'mdp de l''utilisateur',
  `us_avatar` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'url de la photo de profil de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des utilisateurs';

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`us_id`, `us_pseudo`, `us_mail`, `us_mdp`, `us_avatar`) VALUES
(14, 'charline', 'charline@gmail.com', '$2y$10$aa8GyVvUHdGIWY7rF8pXxeRV4tdFK67d414jEfs0udlKVZPxlzn7y', ''),
(31, 'antoine', 'antoine@gmail.com', '$2y$10$r1QisSDCeWUcyO7g2YeGr.1Q/1HQ81UWVtiVp9Co7KrPryFp41oVq', ''),
(32, 'a', 'charline@gmail.com', '$2y$10$72FxKtMHrVqZJJiGuGohmuTcTsb3Zj/qBxPfFID3kdUl/ulL/3rvi', ''),
(33, 'charline', 'a', '$2y$10$HcW7oTlQAUODYvjOzC0.Y.f6Y4a/1dmh9ew3RCB.QYSYRju8yKLNS', '');

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
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant du channel';
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `fr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifint de la relation';
--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `mb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la relation';
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de la relation';
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de l''utilisateur', AUTO_INCREMENT=34;
