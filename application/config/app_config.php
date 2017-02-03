<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['admin_path'] = 'admin/';
$config['assets_path'] = 'assets/';
$config['user_page'] = 'account';

/* administration menus */
$config['menus'] = array(
	
	'home' => array(
		'label' => 'Dashboard',
		'icon' => 'fa-laptop',
	),



	'settings' => array(
		'label' => 'Settings',
		'icon' => 'fa-wrench',
	),	

	'admin_users' => array(
		'label' => 'Administrators',
		
		'icon' => 'fa-android',
		'items' => array(
			'admin_users' => array('label' => 'Manage Admins'),
			'admin_users/add' => array('label' => 'Create an Admin'),
			'roles' => array('label' => 'Manage Roles'),
			'permissions' => array('label' => 'Manage Permissions'),  
		),
	),
	

	'auth/account' => array(
		'label' => 'Edit Account',
		'icon' => 'fa-pencil',
	),
	'logout' => array(
		'label' => 'Logout',
		'icon' => 'fa-sign-out',
	),
	
	
);	

