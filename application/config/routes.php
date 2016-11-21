<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 	"home/index";
$route['404_override'] = 'home/page_404_error';

$route['404_error']         =   'home/page_404_error';
//Home page
$route['login']				=	'home/login';
$route['register']			=	'home/register';
$route['complete/(:any)/(:any)'] =	'account/complete/$1/$2';
$route['forgot-password']	=	'home/forgot_password';
$route['app']		        =	'home/application';
$route['app/(:any)']		=	'home/detail/$1';
$route['logout']			=	'home/logout';
$route['faq']				=	'faq/index';
$route['faq/(:any)/(:any)']	=	'faq/detail/$1/$2';
$route['download/(:any)/(:any)/(:any)']    =   'home/download/$1/$2/$3';
$route['install/(:any)/(:any)']    =   'home/download/$1/$2';

$route['action/checkregister']=	'action/account/register';
$route['action/checklogin']=	'action/account/login';

//Admin page
$route['admin']				=	'admin/index/login';
$route['admin/login']		=	'admin/index/login';
$route['admin/application']	=	'admin/index/game';
$route['admin/users']		=	'admin/user/users';
$route['admin/users/(:any)']		=	'admin/user/users/$1';
$route['admin/logout']		=	'admin/action/logout';
$route['admin/application/upload']		=	'admin/game/up';
$route['admin/application/edit/(:any)']	=	'admin/game/edit/$1';
$route['admin/application/start']		=	'admin/game/start';
$route['admin/application/start/(:any)']=	'admin/game/start/$1';
$route['admin/application/stop']		=	'admin/game/stop';
$route['admin/application/stop/(:any)']	=	'admin/game/stop/$1';
$route['admin/application/images/(:any)']=  'admin/game/images/$1';
$route['admin/application/project']		=	'admin/game/info';
$route['admin/application/project/(:any)']		=	'admin/game/info/$1';
$route['admin/application/add_project']	=	'admin/game/add_project';
$route['admin/application/edit_project/(:any)']	=	'admin/game/edit_project/$1';
$route['admin/application/users_app']	=	'admin/game/users_app';


//Action xử lý
$route['admin/addproject']				=	'admin/action_project/up_project';
$route['admin/addapp']					=	'admin/action_project/up_app';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
