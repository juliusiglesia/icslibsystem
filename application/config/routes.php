<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

$route['404_override'] = '';
$route['default_controller'] = 'borrower';
$route['admin/reservation'] = 'admin/reservation_queue';
$route['admin/notification'] = 'admin/notification';
$route['admin/inventory'] = 'admin/print_inventory';
$route['admin/login'] = 'admin/login';

$route['borrower'] = 'borrower';
$route['login'] = 'borrower/login';
$route['logout'] = 'borrower/logout';
$route['inside_search'] = 'borrower/inside_search';
$route['outside_search'] = 'borrower/outside_search';
$route['profile'] = 'borrower/load_profile';
$route['reserve'] = 'borrower/reserve';
$route['reserve_continue'] = 'borrower/reserve_continue';
$route['search'] = 'borrower/search';
$route['register'] = 'borrower/register';
$route['reserved_materials'] = 'borrower/reserved_materials_view';
$route['borrowed_materials'] = 'borrower/borrowed_materials_view';
$route['user_search'] = 'borrower/user_search';
$route['update_email'] = 'borrower/update_email';
$route['update_password'] = 'borrower/update_password';
$route['cancel_reservation'] = 'borrower/cancel_reservation';
$route['registration'] = 'borrower/registration';
$route['verify_account'] = 'borrower/verify_account';
$route['advanced_search'] = 'borrower/advanced_search';


/* End of file routes.php */
/* Location: ./application/config/routes.php */