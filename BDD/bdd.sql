-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour blog
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `blog`;

-- Listage de la structure de la table blog. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Listage des données de la table blog.category : ~6 rows (environ)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(19, 'FOOD'),
	(20, 'SPORT'),
	(21, 'GAME'),
	(22, 'PHP'),
	(23, 'FUN'),
	(24, 'ART');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Listage de la structure de la table blog. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_message`) USING BTREE,
  KEY `FK_message_member` (`user_id`) USING BTREE,
  KEY `FK_message_topic` (`topic_id`),
  CONSTRAINT `FK_message_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_message_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Listage des données de la table blog.message : ~2 rows (environ)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`id_message`, `message`, `creationDate`, `topic_id`, `user_id`) VALUES
	(24, 'J&#039;aime les burgers', '2022-07-08 10:33:45', 26, 12),
	(25, 'Je vais bient&ocirc;t aller le visiter', '2022-07-08 15:08:18', 27, 13);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Listage de la structure de la table blog. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `creationdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `FK_topic_member` (`user_id`) USING BTREE,
  KEY `FK_topic_categorie` (`category_id`) USING BTREE,
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Listage des données de la table blog.topic : ~2 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `creationdate`, `closed`, `user_id`, `category_id`) VALUES
	(26, 'Burger', '2022-07-08 10:33:45', NULL, 12, 19),
	(27, 'Le Louvre', '2022-07-08 15:08:18', NULL, 13, 24);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table blog. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` json NOT NULL,
  `registerDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table blog.user : ~3 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `roles`, `registerDate`) VALUES
	(12, 'Nicolas099', 'ni@ni.fr', '$2y$10$p2acD56hRkbyc19AOKOBUOR/J9baKr1zKgTuBTVCDYHlhnwZOblJa', '["ROLE_ADMIN"]', '2022-06-30 16:55:54'),
	(13, 'Nicolas068', 'ni@fsdf.fr', '$2y$10$MKHPor8kCN3czFSCD/uvBuLvgK79bVJ1j0JTzxYRNz3u61tuwOJwS', '["ROLE_USER"]', '2022-07-01 15:28:40'),
	(14, 'Kevin068', 'k@ge.fr', '$2y$10$WqX3S76WxWBiHAkLsf1MpeHdj7N9mc9..QBx.h2bNU6XwkRktlJi2', '["ROLE_USER"]', '2022-07-08 10:50:19');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
