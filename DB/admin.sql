-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.32 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `reset_password_key` varchar(32) DEFAULT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(60) NOT NULL,
  `last_ip` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `role_code` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_username` (`username`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table admin: ~2 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`, `salt`, `reset_password_key`, `first_name`, `last_name`, `email`, `contact_no`, `last_ip`, `created`, `updated`, `active`, `role_code`) VALUES
	(1, 'admin', 'b9f60dca3f9534a68d495f6f21e64ced', 'qwe123', '', 'Petru', 'Anton', 'petea_ro@yahoo.com', '-', '127.0.0.1', '2011-11-30 02:40:33', '2015-06-22 08:27:22', 1, 'super');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Dumping structure for table admin_roles
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `code` varchar(5) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Dumping structure for table admin_role_permissions
CREATE TABLE IF NOT EXISTS `admin_role_permissions` (
  `role_code` varchar(5) NOT NULL,
  `permission_code` varchar(40) NOT NULL,
  KEY `Index_1` (`role_code`),
  KEY `Index_2` (`permission_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
