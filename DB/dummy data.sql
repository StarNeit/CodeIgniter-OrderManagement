INSERT INTO `user` (`id`, `email`, `salutation`, `first_name`, `last_name`, `photo`, `contact_home`, `contact_mobile`, `password`, `salt`, `forgot_code`, `verify_code`, `is_verified`, `user_type`, `verified_at`, `registered_at`, `is_active`, `last_updated`)
VALUES
	(135, 'client@homage.com', 'Mr', 'Emma', 'Watson', '', '70000007', '70000007', '67f607c34fbd2e07a83b20fae1114e17', 'f80bcb70721f', '', '', 0, 'Client', '0000-00-00 00:00:00', '2016-10-13 17:48:00', 1, '2016-10-13 17:57:42');


INSERT INTO `user_location` (`id`, `user_id`, `building`, `street`, `block`, `unit`, `postal_code`, `lat`, `lng`)
VALUES
	(137, 135, '', '1 Scotts Road', '453', '#07-228', '228208', '', '');


INSERT INTO `client` (`id`, `user_id`, `know_how`, `last_updated`)
VALUES
	(21, 135, 'My friend told me', '2016-10-13 17:48:57');

INSERT INTO `recipient` (`id`, `user_id`, `relationship`, `salutation`, `first_name`, `last_name`, `photo`, `nationality`, `nric`, `dob`, `gender`, `weight`, `height`, `religion`, `race`, `marital_status`, `current_residence`, `residence_note`, `pets`, `pets_note`, `diagnosis`, `medical_condition`, `created_at`, `deleted_at`, `last_updated`)
VALUES
	(35, 135, 'Father', 'Mr', 'John', 'Richard', '', '', '12345678', '1948-03-15', 'Male', 64.00, 168.00, '', 'Eurasian', 'Married', '', '', 0, '', 'Diabetic', 'Heart Patient- undergone bypass surgery', '2016-10-13 17:56:00', '0000-00-00 00:00:00', '2016-10-13 17:56:24');

INSERT INTO `recipient_language` (`id`, `recipient_id`, `language`)
VALUES
	(852, 35, 'English');

INSERT INTO `recipient_location` (`id`, `recipient_id`, `building`, `street`, `block`, `unit`, `postal_code`, `lat`, `lng`)
VALUES
	(31, 35, '', '1 Scotts Road', '453', '#07-228', '228208', '', '');


INSERT INTO `case` (`id`, `recipient_id`, `gender_pref`, `full_care`, `hours`, `special_instructions`, `service_from`, `created_by`, `created_at`, `admin_id`, `staff_updated`, `last_updated`, `is_active`)
VALUES
	(40, 35, 'Female', 0, 0.00, '', '2016-10-17 00:00:00', 'Staff', '2016-10-13 18:01:00', NULL, '2016-10-13 18:01:00', '2016-10-13 17:57:23', 1);


INSERT INTO `case_checklist` (`id`, `case_id`, `item`, `skill_id`, `order`, `is_active`, `last_updated`)
VALUES
	(34, 40, 'Medication before and after meal', 1, 0, 1, '2016-10-13 18:01:31'),
	(35, 40, 'Board Games', 26, 0, 1, '2016-10-13 18:01:31'),
	(36, 40, 'Strecth Exercises', 1, 0, 1, '2016-10-13 18:01:31'),
	(37, 40, 'Diaper Change every 2 hours', 23, 0, 1, '2016-10-13 18:01:31'),
	(38, 40, 'Morning Shower', 22, 0, 1, '2016-10-13 18:01:31'),
	(39, 40, 'Wheel Chair ', 14, 0, 1, '2016-10-13 18:01:31');

INSERT INTO `case_language` (`id`, `case_id`, `language`)
VALUES
	(551, 40, 'English');


INSERT INTO `case_location` (`id`, `case_id`, `building`, `street`, `block`, `unit`, `postal_code`, `lat`, `lng`)
VALUES
	(51, 40, '', '1 Scotts Road', '453', '#07-228', '228208', '', '');

INSERT INTO `case_skill` (`id`, `case_id`, `skill_id`, `is_active`)
VALUES
	(702, 40, 1, 1),
	(703, 40, 3, 1),
	(704, 40, 7, 0),
	(705, 40, 14, 1),
	(706, 40, 22, 1),
	(707, 40, 23, 1),
	(708, 40, 26, 1);


INSERT INTO `user` (`id`, `email`, `salutation`, `first_name`, `last_name`, `photo`, `contact_home`, `contact_mobile`, `password`, `salt`, `forgot_code`, `verify_code`, `is_verified`, `user_type`, `verified_at`, `registered_at`, `is_active`, `last_updated`)
VALUES
	(136, 'carepro@homage.com', 'Mr', 'Melissa', 'Palmer', '', '70000009', '70000008', 'b83ec87dfb3b45d1faa792474ef9fa8d', '44fe52d97b69', '', '', 0, 'CarePro', '0000-00-00 00:00:00', '2016-10-13 18:12:00', 1, '2016-10-13 18:12:21');

INSERT INTO `user_location` (`id`, `user_id`, `building`, `street`, `block`, `unit`, `postal_code`, `lat`, `lng`)
VALUES
	(138, 136, '', 'Alexandra Road', '456', '#08-334', '228228', '', '');

INSERT INTO `carepro` (`id`, `user_id`, `nationality`, `national_id`, `dob`, `gender`, `weight`, `height`, `religion`, `race`, `summary`, `medical_conditions`, `smart_phone`, `application_status`, `registered_at`, `last_updated`)
VALUES
	(164, 136, 'Singapore Citizen', '12345678', '1981-04-14', 'Female', 56.00, 158.00, 'Christian', 'Chinese', '', 'no', 0, 'Received', '2016-10-13 18:12:00', '2016-10-13 18:12:21');

INSERT INTO `carepro_application` (`id`, `user_id`, `experience_summary`, `experience_years`, `criminal_record`, `criminal_detail`, `full_name`, `ref_name`, `ref_relationship`, `ref_contact`, `ref_email`, `sec_ref_name`, `sec_ref_relationship`, `sec_ref_contact`, `sec_ref_email`)
VALUES
	(131, 136, 'I graduated nurse.', '1 - 3 years', 0, '', 'Melissa Palmer', 'Asdf', 'fdsa', '7000010', '', 'Lkjh', 'hjkl', '70000011', '');

INSERT INTO `carepro_experience` (`id`, `user_id`, `experience`)
VALUES
	(229, 136, 'Parkinsons'),
	(230, 136, 'Stroke'),
	(231, 136, 'Others');

INSERT INTO `carepro_skill` (`id`, `user_id`, `skill_id`)
VALUES
	(918, 136, 8),
	(919, 136, 12),
	(920, 136, 13),
	(921, 136, 14),
	(922, 136, 15),
	(923, 136, 16),
	(924, 136, 17),
	(925, 136, 18),
	(926, 136, 19),
	(927, 136, 20),
	(928, 136, 21),
	(929, 136, 22),
	(930, 136, 23),
	(931, 136, 24),
	(932, 136, 25),
	(933, 136, 26),
	(934, 136, 27);

INSERT INTO `carepro_training` (`id`, `user_id`, `training`)
VALUES
	(115, 136, 'Diploma in Nursing and above'),
	(116, 136, 'Certification in Caregiving'),
	(117, 136, 'Formal First Aid Certification');

INSERT INTO `visit` (`id`, `case_id`, `visit_from`, `visit_to`, `full_day`, `building`, `street`, `block`, `unit`, `postal_code`, `lat`, `lng`, `instructions`, `clock_in`, `clock_out`, `alert`, `pain`, `pain_location`, `summary`, `comments`, `rating`, `review`, `status`, `last_updated`)
VALUES
	(20, 40, '2016-10-14 19:00:00', '2016-10-14 22:00:00', 0, '', '1 Scotts Road', '453', '#07-228', '228208', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', 0, '', 'Completed', '2016-10-13 18:17:10'),
	(21, 40, '2016-10-15 10:00:00', '2016-10-15 17:00:00', 0, '', '1 Scotts Road', '453', '#07-228', '228208', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', 0, '', 'Assigned', '2016-10-13 18:17:11'),
	(22, 40, '2016-10-17 16:00:00', '2016-10-17 21:00:00', 0, '', '1 Scotts Road', '453', '#07-228', '228208', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', 0, '', 'Pending', '2016-10-13 18:05:10');

INSERT INTO `visit_carepro` (`id`, `visit_id`, `carepro_id`, `bid_at`, `assigned_at`, `status`, `last_updated`)
VALUES
	(10, 20, 164, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Assigned', '2016-10-13 18:17:01'),
	(11, 21, 164, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Assigned', '2016-10-13 18:17:01');
