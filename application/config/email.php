<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['mailtype'] = 'html';
$config['protocol'] = 'mail';
$config['charset'] = "utf-8";

if($_SERVER["REMOTE_ADDR"] == "127.0.0.1" || $_SERVER["REMOTE_ADDR"] == "::1" )
{		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_user'] = 'userjohny83@gmail.com';
		$config['smtp_pass'] = 'fatfrumos1';
		$config['smtp_port'] = "465";
		$config['smtp_timeout'] = "5";
		
}