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
$route['default_controller'] = 'catalog';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['catalog/printfull_image/(\d+).png']			= 'catalog/printfull_image/$1';
$route['catalog/(:any)']							= 'catalog/$1';
$route['order/(:any)']								= 'order/$1';

$route['campaign/(:any)']							= 'campaign/$1';
$route['campaign/(:any)/(:any)']					= 'campaign/$1/$2';

$route['catalog/product.json']						= 'catalog/product_json';

$route['admin']										= 'admin';
$route['admin/(:any)']								= 'admin/$1';
$route['admin/(:any)/(:any)']						= 'admin/$1/$2';

$route['social_login']								= 'auth/social_login';
$route['auth/(:any)']								= 'auth/$1';

$route['cart']										= 'cart';
$route['cart/(:any)']								= 'cart/$1';

$route['cron']										= 'cron';
$route['cron/(:any)']								= 'cron/$1';
$route['cron/(:any)/(:any)']						= 'cron/$1/$2';

$route['customer/orders']							= 'customer/orders_c';
$route['customer/orders/(:any)']					= 'customer/orders_c/$1';
$route['customer/orders/(:any)/(:any)']				= 'customer/orders_c/$1';

$route['customer/profile']							= 'customer/profile';
$route['customer/profile/(:any)']					= 'customer/profile/$1';

$route['cron/(:any)']								= 'cron/$1';
$route['webhooks/(:any)']							= 'webhooks/$1';


$route['(terms|privacy).html']						= 'welcome/$1';

$route['request-lastname']							= 'lastnames/request_lastname';

$route['lastnames/insert_logos'] 					= 'lastnames/insert_logos';
$route['lastnames'] 								= 'lastnames/lastnames';
$route['lastnames/(:any)'] 							= 'lastnames/lastnames';
$route['lastnames/(:any)/(:any)'] 					= 'lastnames/lastnames';


$route['print_designer']							= 'print_designer';
$route['print_designer/(:any)']						= 'print_designer/$1';

$route['new-aff']									= 'auth/new_aff';
$route['new-aff-complete']							= 'auth/new_aff_complete';

// $route['aff-login']									= 'auth/aff_login';

//STOREADMIN
$route[STORE_ADMIN_URL_PREFIX . '/login']			= 'auth/aff_login';
$route[STORE_ADMIN_URL_PREFIX]						= 'storeadmin/orders_s';

$route[STORE_ADMIN_URL_PREFIX . '/orders/order/(\d+)']		= 'storeadmin/orders_s/order/$1';
$route[STORE_ADMIN_URL_PREFIX . '/orders/(:any)']			= 'storeadmin/orders_s/$1';
$route[STORE_ADMIN_URL_PREFIX . '/orders/(:any)/(:any)']	= 'storeadmin/orders_s/$1';
$route[STORE_ADMIN_URL_PREFIX . '/orders']					= 'storeadmin/orders_s';



$route[STORE_ADMIN_URL_PREFIX . '/customers']		= 'storeadmin/customers_s';
$route[STORE_ADMIN_URL_PREFIX . '/settings']		= 'storeadmin/settings_s';
$route[STORE_ADMIN_URL_PREFIX . '/settings/(:any)']	= 'storeadmin/settings_s/$1';

$route[STORE_ADMIN_URL_PREFIX . '/stats']			= 'storeadmin/stats_s';
$route[STORE_ADMIN_URL_PREFIX . '/stats/(:any)']	= 'storeadmin/stats_s';

$route[STORE_ADMIN_URL_PREFIX . '/profile']			= 'storeadmin/profile_s';

$route[STORE_ADMIN_URL_PREFIX . '/campaigns']		= 'storeadmin/campaigns_s';
$route[STORE_ADMIN_URL_PREFIX . '/campaigns/(:any)']= 'storeadmin/campaigns_s/$1';
$route[STORE_ADMIN_URL_PREFIX . '/campaigns/(:any)/(:any)']= 'storeadmin/campaigns_s/$1/$2';

$route[STORE_ADMIN_URL_PREFIX . '/dashboard']		= 'storeadmin/dashboard_s';
$route[STORE_ADMIN_URL_PREFIX . '/dashboard/(:any)']= 'storeadmin/dashboard_s/$1';
$route[STORE_ADMIN_URL_PREFIX . '/dashboard/(:any)/(:any)']= 'storeadmin/dashboard_s/$1/$2';

$route['logos/(:num_:num).png']						= 'catalog/logo_proxy/$1';

$route['collection/(:num)']							= 'catalog/collection/$1';
$route['remove_from_collection']					= 'catalog/remove_from_collection';

$route['(\w+)/category/(:any)']						= 'catalog/lastname';

$route['(\w+)/categories']							= 'catalog/load_folder_cats';
$route['(\w+)']										= 'catalog/lastname';
$route['(\w+)/(:any)']								= 'catalog/surfaces';
$route['(\w+)/(:any)/(:any)']						= 'catalog/products';
$route['(\w+)/(:any)/(:any)/(:num)']				= 'catalog/product';
$route['(\w+)/(:any)/(:any)/(:num)/custom/(\d+)']	= 'catalog/product/$5';