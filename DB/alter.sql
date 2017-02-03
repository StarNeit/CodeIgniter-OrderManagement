ALTER TABLE `user`
	ADD COLUMN `photo` VARCHAR(255) NOT NULL DEFAULT '' AFTER `last_name`;

ALTER TABLE `carepro_document`
	ADD COLUMN `type` ENUM('CRP','TB','Certificate','IC','Others') NULL DEFAULT NULL AFTER `completion_on`;

ALTER TABLE `carepro_document`
	ADD COLUMN `valid_till` DATE NULL DEFAULT NULL AFTER `completion_on`;

CREATE TABLE `carepro_availability` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `all_day` tinyint(4) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `start` (`start`),
  KEY `end` (`end`),
  KEY `all_day` (`all_day`)
) ENGINE=InnoDB AUTO_INCREMENT=1107 DEFAULT CHARSET=latin1;

ALTER TABLE `case` ADD `created_by` ENUM('Client','Staff')  NULL  DEFAULT 'Client'  AFTER `service_from`;
ALTER TABLE `case` ADD `admin_id` INT(11)  UNSIGNED  NULL  DEFAULT NULL  AFTER `created_at`;
ALTER TABLE `case` ADD `staff_updated` DATETIME  NULL  DEFAULT '0000-00-00 00:00:00'  AFTER `admin_id`;

ALTER TABLE `recipient` ADD `created_by` ENUM('Client','Staff')  NULL  DEFAULT 'Client'  AFTER `medical_condition`;
ALTER TABLE `recipient` ADD `admin_id` INT(11)  UNSIGNED  NULL  DEFAULT NULL  AFTER `created_at`;
ALTER TABLE `recipient` ADD `staff_updated` DATETIME  NULL  DEFAULT '0000-00-00 00:00:00'  AFTER `admin_id`;

ALTER TABLE `recipient`
  ADD COLUMN `photo` VARCHAR(255) NOT NULL DEFAULT '' AFTER `last_name`;

ALTER TABLE `carepro`
  ADD COLUMN `summary` TEXT NOT NULL DEFAULT '' AFTER `race`;

ALTER TABLE `case_checklist`
  ADD COLUMN `is_active` INT(1) NOT NULL DEFAULT '1' AFTER `order`;

ALTER TABLE `case_skill`
  ADD COLUMN `is_active` INT(1) NOT NULL DEFAULT '1' AFTER `skill_id`;


/* alerts on case_checklist table */
#remove everyting from case_checklist
SET foreign_key_checks=0;
TRUNCATE case_checklist;

#rename case_skill_id column to skill_id
ALTER TABLE `case_checklist`
  DROP FOREIGN KEY `case_checklist_ibfk_2`;
ALTER TABLE `case_checklist`
  ALTER `case_skill_id` DROP DEFAULT;
ALTER TABLE `case_checklist`
  CHANGE COLUMN `case_skill_id` `skill_id` INT(11) UNSIGNED NOT NULL AFTER `item`;

#update foreign key to use skill table as reference
ALTER TABLE `case_checklist`
  ADD CONSTRAINT `FK_case_checklist_skill` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

#rename checklist-id column to checklist
ALTER TABLE `visit_checklist`
  DROP FOREIGN KEY `visit_checklist_ibfk_2`;
ALTER TABLE `visit_checklist`
  ALTER `checklist_id` DROP DEFAULT;
ALTER TABLE `visit_checklist`
  CHANGE COLUMN `checklist_id` `checklist` VARCHAR(1000)  NOT NULL AFTER `visit_id`;

#added lat and lng for case_location
ALTER TABLE `case_location`
    ADD COLUMN `lat` VARCHAR(255) NOT NULL DEFAULT '' AFTER postal_code;
ALTER TABLE `case_location`
    ADD COLUMN `lng` VARCHAR(255) NOT NULL DEFAULT '' AFTER lat;

#added lat and lng for recipient_location
ALTER TABLE `recipient_location`
    ADD COLUMN `lat` VARCHAR(255) NOT NULL DEFAULT '' AFTER postal_code;
ALTER TABLE `recipient_location`
    ADD COLUMN `lng` VARCHAR(255) NOT NULL DEFAULT '' AFTER lat;

#added lat and lng for user_location
ALTER TABLE `user_location`
    ADD COLUMN `lat` VARCHAR(255) NOT NULL DEFAULT '' AFTER postal_code;
ALTER TABLE `user_location`
    ADD COLUMN `lng` VARCHAR(255) NOT NULL DEFAULT '' AFTER lat;

#added lat and lng for visit
ALTER TABLE `visit`
    ADD COLUMN `lat` VARCHAR(255) NOT NULL DEFAULT '' AFTER postal_code;
ALTER TABLE `visit`
    ADD COLUMN `lng` VARCHAR(255) NOT NULL DEFAULT '' AFTER lat;