<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'error';


$route['logout'] = "login/logout";

$route['forgot-password'] = "login/forgot_password";

/********* care pro pages *********/
$route['carepro'] = "carepro/wizard";
$route['carepro/cases/(:any)'] = "carepro/cases/index/$1";
$route['carepro/cases/bid_visit'] = "carepro/cases/bid_visit";

/********* client pages *********/
$route['client'] = "client/care_recipients";
$route['client/visits/(:any)'] = "client/visits/index/$1";
$route['client/visits/details/(:any)'] = "client/visits/details/$1";
$route['admin/visits/(:any)'] = "admin/visits/index/$1";
$route['admin/visits/save'] = "admin/visits/save";
$route['admin/visits/search_skill'] = "admin/visits/search_skill";



/**** admin panel **********/
$route['admin'] = "admin/dashboard";
$route['admin/logout'] = "admin/auth/logout";


$route['ajax-geocode'] = "ajax_geocode";

