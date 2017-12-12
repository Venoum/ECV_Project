-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mer 13 Décembre 2017 à 00:16
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
(1, 'pseudo', 'mail', '$2y$10$1he0IVRD5cwaSNrACVFPBeyUD5jmSwdwVBcTeWK/qoA4RDwjFsljW', ''),
(2, 'pseudo', 'mail', '$2y$10$rQbl5agOKxt4J/C4AWdZWOHyGiLEyLh38m2Dy2sDTW8rZRp3JLzKC', ''),
(3, 'charline', 'charline@gmail.com', '$2y$10$Z0dmaOI2kEVkSceIeQIIgeDF.mhXqqOHAMHuZyachcpNz3iuL.UXe', ''),
(4, 'b', 'b', '$2y$10$LqedPaLkKZv.OCxeidAn0OYMS0pvOHkqlxwITbKMSuFAgLVzO3lMO', ''),
(5, 'c', 'c', '$2y$10$w.dD8tKdVVjHTrMFOn0iS.m75K0ehGwq2Qf2.RRWuEwjThTEYw05W', ''),
(6, 'd', 'd', '$2y$10$2L4bhgumab267y3LZ7tyTOpMmqeNgTkwrH5tkcQXzIfCA7xG1oPni', ''),
(7, 'e', 'e', '$2y$10$bTg/1N6Elo2HS254QHrsZ.EnMnwcEnWzKI2jHd6LNYlPASCgLmEnW', ''),
(8, 'f', 'f', '$2y$10$DPWjqKdEagB1izqcuh.Ui.OEE6i97S2lf6XGiTsrrbCoeH0tF5CsS', ''),
(9, 'g', 'g', '$2y$10$cWJRtc3Qo/JxouuS38htluqKOdmUocc61avpEq2Z63BXC.90Qz4y6', ''),
(10, 'h', 'h', '$2y$10$Jl7HycSbSaShvVK6/lBmguY2ngPRKxqtURl4zOPISVzgedFqMxSnO', ''),
(11, 'i', 'i', '$2y$10$7kigGmk3NJGHroRNU9GCt.Y6oRlYhEd5ARuEQCch7CqVV6f8srCae', ''),
(12, 'jj', 'j', '$2y$10$CGsn/uW0f7SInkr0oU0jludmdSu7Kw3sIXeFzRfFWGQjb5nUzJzKa', ''),
(13, 'k', 'k', '$2y$10$V/Ub83QrRVwOtDy5milDqOENVWQIExPcCw2c2dy6V2ep25FddAdY2', '');

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
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifiant de l''utilisateur', AUTO_INCREMENT=14;
