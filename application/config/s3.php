<?php
/*
| -------------------------------------------------------------------
| Amazon S3 Configuration
| -------------------------------------------------------------------
*/

$config["useSSL"] = TRUE;
$config["accessKey"] = "AKIAIB6ZEF5QP7VQYKFA";
$config["secretKey"] = "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";
$config['bucket'] = 'ac-homage';
$config['endpoint'] = 's3-ap-southeast-1.amazonaws.com';


if(in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')))
{
	$config["useSSL"] = FALSE;
	$config['accessKey'] = 'AKIAJS3XGO5EF5O7CDWA';
	$config['secretKey'] = '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';
	$config['bucket'] = 'homagee';
	$config['endpoint'] = 's3.amazonaws.com';
}