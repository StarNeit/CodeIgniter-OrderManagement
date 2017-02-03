# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: appreneurs.co (MySQL 5.5.38)
# Database: homage_dev
# Generation Time: 2016-08-03 08:21:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table carepro
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carepro`;

CREATE TABLE `carepro` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `nationality` varchar(255) NOT NULL DEFAULT '',
  `national_id` varchar(100) NOT NULL DEFAULT '',
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `weight` double(16,2) NOT NULL,
  `height` double(16,2) NOT NULL,
  `religion` varchar(255) NOT NULL DEFAULT '',
  `race` varchar(255) NOT NULL DEFAULT '',
  `medical_conditions` text NOT NULL,
  `smart_phone` int(1) NOT NULL DEFAULT '0',
  `application_status` enum('Received','In-Review','Shortlisted','Placed','Rejected') NOT NULL DEFAULT 'Received',
  `registered_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `nationality` (`nationality`),
  KEY `national_id` (`national_id`),
  KEY `dob` (`dob`),
  KEY `gender` (`gender`),
  KEY `weight` (`weight`),
  KEY `height` (`height`),
  KEY `religion` (`religion`),
  KEY `race` (`race`),
  KEY `smart_phone` (`smart_phone`),
  KEY `application_status` (`application_status`),
  KEY `registered_at` (`registered_at`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `carepro_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table carepro_application
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carepro_application`;

CREATE TABLE `carepro_application` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `experience_summary` text NOT NULL,
  `experience_years` varchar(255) DEFAULT NULL,
  `criminal_record` int(1) NOT NULL DEFAULT '0',
  `criminal_detail` text NOT NULL,
  `full_name` varchar(255) NOT NULL DEFAULT '',
  `ref_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'ref_',
  `ref_relationship` varchar(255) NOT NULL DEFAULT '',
  `ref_contact` varchar(255) NOT NULL DEFAULT '',
  `ref_email` varchar(255) NOT NULL DEFAULT '',
  `sec_ref_name` varchar(255) NOT NULL DEFAULT '',
  `sec_ref_relationship` varchar(255) NOT NULL DEFAULT '',
  `sec_ref_contact` varchar(255) NOT NULL DEFAULT '',
  `sec_ref_email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `experience_years` (`experience_years`),
  KEY `criminal_record` (`criminal_record`),
  KEY `full_name` (`full_name`),
  KEY `ref_name` (`ref_name`),
  KEY `ref_relationship` (`ref_relationship`),
  KEY `ref_contact` (`ref_contact`),
  KEY `ref_email` (`ref_email`),
  KEY `sec_ref_name` (`sec_ref_name`),
  KEY `sec_ref_relationship` (`sec_ref_relationship`),
  KEY `sec_ref_contact` (`sec_ref_contact`),
  KEY `sec_ref_email` (`sec_ref_email`),
  CONSTRAINT `carepro_application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table carepro_certification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carepro_certification`;

CREATE TABLE `carepro_certification` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `certificate` varchar(255) NOT NULL DEFAULT '',
  `certified_on` date NOT NULL DEFAULT '0000-00-00',
  `expiry` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `certificate` (`certificate`),
  KEY `certified_on` (`certified_on`),
  KEY `expiry` (`expiry`),
  CONSTRAINT `carepro_certification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table carepro_document
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carepro_document`;

CREATE TABLE `carepro_document` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(500) NOT NULL DEFAULT '',
  `document_url` varchar(255) NOT NULL DEFAULT '',
  `completion_on` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `name` (`name`),
  KEY `document_url` (`document_url`),
  KEY `completion_on` (`completion_on`),
  CONSTRAINT `carepro_document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table carepro_experience
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carepro_experience`;

CREATE TABLE `carepro_experience` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `experience` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `experience_id` (`experience`),
  CONSTRAINT `carepro_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table carepro_training
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carepro_training`;

CREATE TABLE `carepro_training` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `training` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `training` (`training`),
  CONSTRAINT `carepro_training_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table client
# ------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `know_how` varchar(500) NOT NULL DEFAULT '',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `know_how` (`know_how`),
  KEY `last_updated` (`last_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `salutation` enum('Mr','Mrs','Ms','Mdm','Dr') NOT NULL DEFAULT 'Mr',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `contact_home` varchar(100) NOT NULL,
  `contact_mobile` varchar(100) NOT NULL,
  `password` char(64) NOT NULL DEFAULT '',
  `salt` char(18) NOT NULL DEFAULT '',
  `forgot_code` char(32) NOT NULL DEFAULT '',
  `verify_code` char(64) NOT NULL,
  `is_verified` int(1) NOT NULL DEFAULT '0',
  `user_type` enum('CarePro','Client') NOT NULL DEFAULT 'Client',
  `verified_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registered_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `salutation` (`salutation`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `contact_home` (`contact_home`),
  KEY `contact_mobile` (`contact_mobile`),
  KEY `password` (`password`),
  KEY `salt` (`salt`),
  KEY `forgot_code` (`forgot_code`),
  KEY `verify_code` (`verify_code`),
  KEY `is_verified` (`is_verified`),
  KEY `user_type` (`user_type`),
  KEY `verified_at` (`verified_at`),
  KEY `registered_at` (`registered_at`),
  KEY `is_active` (`is_active`),
  KEY `last_updated` (`last_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_language
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_language`;

CREATE TABLE `user_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `language` (`language`),
  CONSTRAINT `user_language_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_location
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_location`;

CREATE TABLE `user_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `building` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL DEFAULT '',
  `block` varchar(100) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `building` (`building`),
  KEY `street` (`street`),
  KEY `block` (`block`),
  KEY `unit` (`unit`),
  KEY `postal_code` (`postal_code`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


# Add new Tables
-- Create syntax for TABLE 'service'
CREATE TABLE `service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `order` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service` (`service`),
  KEY `icon` (`icon`),
  KEY `order` (`order`),
  KEY `is_active` (`is_active`),
  KEY `last_updated` (`last_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'skill'
CREATE TABLE `skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) unsigned DEFAULT NULL,
  `skill` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `sub_description` varchar(1000) NOT NULL DEFAULT '',
  `order` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `skill` (`skill`),
  KEY `description` (`description`(767)),
  KEY `sub_description` (`sub_description`(767)),
  KEY `order` (`order`),
  KEY `is_active` (`is_active`),
  KEY `last_updated` (`last_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'recipient'
CREATE TABLE `recipient` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `relationship` varchar(255) NOT NULL DEFAULT '',
  `salutation` enum('Mr','Mrs','Ms','Mdm','Dr') NOT NULL DEFAULT 'Mr',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `nationality` varchar(255) NOT NULL DEFAULT '',
  `nric` varchar(100) NOT NULL,
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `weight` double(16,2) NOT NULL,
  `height` double(16,2) NOT NULL,
  `religion` varchar(255) NOT NULL DEFAULT '',
  `race` varchar(255) NOT NULL DEFAULT '',
  `marital_status` enum('Married','Widowed','Single','Divorced') NOT NULL DEFAULT 'Married',
  `current_residence` varchar(255) NOT NULL DEFAULT '',
  `residence_note` varchar(1000) NOT NULL DEFAULT '',
  `pets` int(1) NOT NULL DEFAULT '0',
  `pets_note` varchar(1000) NOT NULL DEFAULT '',
  `diagnosis` text NOT NULL,
  `medical_condition` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `relationship` (`relationship`),
  KEY `salutation` (`salutation`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `nationality` (`nationality`),
  KEY `nric` (`nric`),
  KEY `dob` (`dob`),
  KEY `gender` (`gender`),
  KEY `weight` (`weight`),
  KEY `height` (`height`),
  KEY `religion` (`religion`),
  KEY `race` (`race`),
  KEY `marital_status` (`marital_status`),
  KEY `current_residence` (`current_residence`),
  KEY `residence_note` (`residence_note`(767)),
  KEY `pets` (`pets`),
  KEY `pets_note` (`pets_note`(767)),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `last_updated` (`last_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'recipient_language'
CREATE TABLE `recipient_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) unsigned NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `language` (`language`),
  CONSTRAINT `recipient_language_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'recipient_location'
CREATE TABLE `recipient_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) unsigned NOT NULL,
  `building` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL DEFAULT '',
  `block` varchar(100) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `building` (`building`),
  KEY `street` (`street`),
  KEY `block` (`block`),
  KEY `unit` (`unit`),
  KEY `postal_code` (`postal_code`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `recipient_location_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'recipient_review'
CREATE TABLE `recipient_review` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) unsigned NOT NULL,
  `admin_id` int(11) unsigned NOT NULL,
  `service_summary` text NOT NULL,
  `reviewed_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `special_instructions` text NOT NULL,
  `service_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `followup` int(1) NOT NULL DEFAULT '0',
  `followup_note` varchar(1000) NOT NULL DEFAULT '',
  `remarks` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `admin_id` (`admin_id`),
  KEY `reviewed_at` (`reviewed_at`),
  KEY `service_from` (`service_from`),
  KEY `followup` (`followup`),
  KEY `followup_note` (`followup_note`(767)),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `recipient_review_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'case'
CREATE TABLE `case` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) unsigned NOT NULL,
  `gender_pref` enum('Male','Female','None') NOT NULL DEFAULT 'None',
  `full_care` int(1) NOT NULL DEFAULT '0',
  `hours` double(16,2) NOT NULL,
  `special_instructions` varchar(1000) NOT NULL DEFAULT '',
  `service_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `gender_pref` (`gender_pref`),
  KEY `full_care` (`full_care`),
  KEY `hours` (`hours`),
  KEY `special_instructions` (`special_instructions`(767)),
  KEY `service_from` (`service_from`),
  KEY `created_at` (`created_at`),
  KEY `last_updated` (`last_updated`),
  KEY `is_active` (`is_active`),
  CONSTRAINT `case_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'case_language'
CREATE TABLE `case_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `case_id` int(11) unsigned NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'case_skill'
CREATE TABLE `case_skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `case_id` int(11) unsigned NOT NULL,
  `skill_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `case_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `case_skill_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `case` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `case_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `case_id` int(11) unsigned NOT NULL,
  `building` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL DEFAULT '',
  `block` varchar(100) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `building` (`building`),
  KEY `street` (`street`),
  KEY `block` (`block`),
  KEY `unit` (`unit`),
  KEY `postal_code` (`postal_code`),
  KEY `case_id` (`case_id`),
  CONSTRAINT `case_location_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `case` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `carepro_skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `skill_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skill_id` (`skill_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `carepro_skill_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carepro_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'case_checklist'
CREATE TABLE `case_checklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `case_id` int(11) unsigned NOT NULL,
  `item` varchar(500) NOT NULL DEFAULT '',
  `case_skill_id` int(11) unsigned NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`),
  KEY `case_skill_id` (`case_skill_id`),
  KEY `item` (`item`),
  KEY `order` (`order`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `case_checklist_ibfk_2` FOREIGN KEY (`case_skill_id`) REFERENCES `case_skill` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `case_checklist_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `case` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'visit'
CREATE TABLE `visit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `case_id` int(11) unsigned NOT NULL,
  `visit_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `visit_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `full_day` int(1) NOT NULL DEFAULT '0',
  `building` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL DEFAULT '',
  `block` varchar(100) NOT NULL DEFAULT '',
  `unit` varchar(50) NOT NULL DEFAULT '',
  `postal_code` varchar(25) NOT NULL DEFAULT '',
  `instructions` text NOT NULL,
  `clock_in` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `clock_out` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `alert` varchar(255) NOT NULL DEFAULT '',
  `pain` varchar(255) NOT NULL DEFAULT '',
  `pain_location` varchar(255) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `comments` text NOT NULL,
  `rating` int(2) NOT NULL DEFAULT '0',
  `review` varchar(500) NOT NULL DEFAULT '',
  `status` enum('Pending','Assigned','Completed','Declined','Cancelled') NOT NULL DEFAULT 'Pending',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `case_id` (`case_id`),
  KEY `visit_from` (`visit_from`),
  KEY `visit_to` (`visit_to`),
  KEY `full_day` (`full_day`),
  KEY `building` (`building`),
  KEY `street` (`street`),
  KEY `block` (`block`),
  KEY `unit` (`unit`),
  KEY `postal_code` (`postal_code`),
  KEY `clock_in` (`clock_in`),
  KEY `clock_out` (`clock_out`),
  KEY `alert` (`alert`),
  KEY `pain` (`pain`),
  KEY `pain_location` (`pain_location`),
  KEY `rating` (`rating`),
  KEY `review` (`review`),
  KEY `status` (`status`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `case` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'visit_carepro'
CREATE TABLE `visit_carepro` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) unsigned NOT NULL,
  `carepro_id` int(11) unsigned NOT NULL,
  `bid_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `assigned_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('Bid','Assigned','Not Assigned','Confirmed') NOT NULL DEFAULT 'Bid',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_id` (`visit_id`),
  KEY `carepro_id` (`carepro_id`),
  KEY `bid_at` (`bid_at`),
  KEY `assigned_at` (`assigned_at`),
  KEY `status` (`status`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `visit_carepro_ibfk_2` FOREIGN KEY (`carepro_id`) REFERENCES `carepro` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `visit_carepro_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'visit_checklist'
CREATE TABLE `visit_checklist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) unsigned NOT NULL,
  `checklist_id` int(11) unsigned NOT NULL,
  `check` int(1) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_id` (`visit_id`),
  KEY `checklist_id` (`checklist_id`),
  KEY `check` (`check`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `visit_checklist_ibfk_2` FOREIGN KEY (`checklist_id`) REFERENCES `case_checklist` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `visit_checklist_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'visit_photo'
CREATE TABLE `visit_photo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) unsigned NOT NULL,
  `photo_thumb` varchar(255) NOT NULL DEFAULT '',
  `photo` varchar(255) NOT NULL DEFAULT '',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_id` (`visit_id`),
  KEY `photo_thumb` (`photo_thumb`),
  KEY `photo` (`photo`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `visit_photo_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create syntax for TABLE 'carepro_review'
CREATE TABLE `carepro_review` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `carepro_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned DEFAULT NULL,
  `visit_id` int(11) unsigned DEFAULT NULL,
  `rating` int(2) NOT NULL DEFAULT '0',
  `review` varchar(500) NOT NULL DEFAULT '',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `carepro_id` (`carepro_id`),
  KEY `client_id` (`client_id`),
  KEY `visit_id` (`visit_id`),
  KEY `rating` (`rating`),
  KEY `review` (`review`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `carepro_review_ibfk_3` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `carepro_review_ibfk_1` FOREIGN KEY (`carepro_id`) REFERENCES `carepro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carepro_review_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `visit_skill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) unsigned NOT NULL,
  `skill_id` int(11) unsigned NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_id` (`visit_id`),
  KEY `skill_id` (`skill_id`),
  KEY `last_updated` (`last_updated`),
  CONSTRAINT `visit_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `visit_skill_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
