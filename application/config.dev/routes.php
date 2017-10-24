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

/* System route */
$route['default_controller'] = 'app123/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* index page */
$route['app123'] = 'app123/index';

/* AB test */
$route['ab']                = 'page/ab/index';
$route['ajaxGetABTest']     = 'ajax/ab/ajaxGetABTest';
$route['ajaxGetTestGroups'] = 'ajax/ab/ajaxGetTestGroups';

/* Log File */
$route['logfile']        = 'page/logfile/index';
$route['ajaxGetLogfile'] = 'ajax/logfile/ajaxGetLogfile';

/* info */
$route['team']           = 'page/info/team';
$route['event']          = 'page/info/event';
$route['ajaxGetRota']    = 'ajax/info/ajaxGetRota';
$route['ajaxChangeDuty'] = 'ajax/info/ajaxChangeDuty';
$route['ajaxGetEvents']  = 'ajax/info/ajaxGetEvents';
$route['ajaxAddEvent']   = 'ajax/info/ajaxAddEvent';

/* idc */
$route['idc']            = 'page/idc/index';
$route['ajaxGetIdcs']    = 'ajax/idc/ajaxGetIdcs';
$route['ajaxGetIdcCode'] = 'ajax/idc/ajaxGetIdcCode';
$route['ajaxAddIdc']     = 'ajax/idc/ajaxAddIdc';
$route['ajaxUpdateIdc']  = 'ajax/idc/ajaxUpdateIdc';
$route['ajaxDeleteIdc']  = 'ajax/idc/ajaxDeleteIdc';

/* host */
$route['host']            = 'page/host/index';
$route['ajaxGetHosts']    = 'ajax/host/ajaxGetHosts';
$route['ajaxAddHost']     = 'ajax/host/ajaxAddHost';
$route['ajaxUpdateHost']  = 'ajax/host/ajaxUpdateHost';
$route['ajaxDeleteHost']  = 'ajax/host/ajaxDeleteHost';

/* service */
$route['test']              = 'page/service/test';
$route['service']           = 'page/service/service';
$route['ajaxTreeServices']  = 'ajax/service/ajaxTreeServices';
$route['ajaxTreeNode']      = 'ajax/service/ajaxTreeNode';
$route['ajaxSubServices']   = 'ajax/service/ajaxSubServices';
$route['ajaxAddService']    = 'ajax/service/ajaxAddService';
$route['ajaxUpdateService'] = 'ajax/service/ajaxUpdateService';
$route['ajaxDeleteService'] = 'ajax/service/ajaxDeleteService';

$route['deployment']               = 'page/service/deployment';
$route['ajaxUpdate']               = 'ajax/service/ajaxUpdate';
$route['ajaxPause']                = 'ajax/service/ajaxPause';
$route['ajaxResume']               = 'ajax/service/ajaxResume';
$route['ajaxRollback']             = 'ajax/service/ajaxRollback';
$route['ajaxGetDeployment']        = 'ajax/service/ajaxGetDeployment';
$route['ajaxGetDeploymentStatus']  = 'ajax/service/ajaxGetDeploymentStatus';
$route['ajaxGetDeploymentHistory'] = 'ajax/service/ajaxGetDeploymentHistory';
$route['ajaxGetImages']            = 'ajax/service/ajaxGetImages';
$route['ajaxConfigDeployment']     = 'ajax/service/ajaxConfigDeployment';

$route['status']           = 'page/service/status';
$route['ajaxGetJDKStatus'] = 'ajax/service/ajaxGetJDKStatus';
$route['ajaxGetPodLog']    = 'ajax/service/ajaxGetPodLog';

/* admin */
$route['admin']              = 'page/admin/index';
$route['ajaxGetUsers']       = 'ajax/admin/ajaxGetUsers';
$route['ajaxGetUserOpts']    = 'ajax/admin/ajaxGetUserOpts';
$route['ajaxGetServiceOpts'] = 'ajax/admin/ajaxGetServiceOpts';
$route['ajaxGetRoleOpts']    = 'ajax/admin/ajaxGetRoleOpts';
$route['ajaxAddUser']        = 'ajax/admin/ajaxAddUser';
$route['ajaxAddAuth']        = 'ajax/admin/ajaxAddAuth';

/* authority */
$route['login']              = 'page/auth/index';
$route['loginCommit']        = 'page/auth/login';
$route['logout']             = 'page/auth/logout';
$route['profile']            = 'page/auth/profile';
$route['ajaxUpdateProfile']  = 'ajax/auth/ajaxUpdateProfile';
$route['ajaxUpdatePassword'] = 'ajax/auth/ajaxUpdatePassword';
$route['mine']               = 'page/auth/mine';
$route['ajaxGetMineAuth']    = 'ajax/auth/ajaxGetMineAuth';

/* API */
$route['api/idc']['GET']           = 'api/idc/getIdcs';
$route['api/idc']['POST']          = 'api/idc/addIdcs';
$route['api/idc/(:num)']['DELETE'] = 'api/idc/deleteIdc/$1';

$route['api/host']['GET']           = 'api/host/getHosts';
$route['api/host']['POST']          = 'api/host/addHosts';
$route['api/host/(:num)']['DELETE'] = 'api/host/deleteHost/$1';
