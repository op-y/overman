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
|	https://codeigniter.com/user_guide/general/routing.html
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

/* billboard */
$route['billboard'] = 'billboard/index';

/* info */
$route['team']           = 'info/team';
$route['ajaxGetRota']    = 'info/ajaxGetRota';
$route['ajaxChangeDuty'] = 'info/ajaxChangeDuty';
$route['event']          = 'info/event';
$route['ajaxGetEvents']  = 'info/ajaxGetEvents';
$route['ajaxAddEvent']   = 'info/ajaxAddEvent';

/* idc */
$route['idc']           = 'idc/index';
$route['ajaxGetIdcs']   = 'idc/ajaxGetIdcs';
$route['ajaxAddIdc']    = 'idc/ajaxAddIdc';
$route['ajaxUpdateIdc'] = 'idc/ajaxUpdateIdc';
$route['ajaxDeleteIdc'] = 'idc/ajaxDeleteIdc';

/* host */
$route['host']            = 'host/index';
$route['ajaxGetHosts']    = 'host/ajaxGetHosts';
$route['ajaxAddHost']     = 'host/ajaxAddHost';
$route['ajaxUpdateHost']  = 'host/ajaxUpdateHost';
$route['ajaxDeleteHost']  = 'host/ajaxDeleteHost';

/* API */
$route['api/idc']['GET']    = 'api/idc/getIdcs';
$route['api/idc']['POST']   = 'api/idc/addIdcs';
$route['api/idc/(:num)']['DELETE'] = 'api/idc/deleteIdc/$1';

$route['api/host']['GET']           = 'api/host/getHosts';
$route['api/host']['POST']          = 'api/host/addHosts';
$route['api/host/(:num)']['DELETE'] = 'api/host/deleteHost/$1';

/* System route */
$route['default_controller'] = 'billboard/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
