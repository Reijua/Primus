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

$route['default_controller'] = "home";
$route['404_override'] = '';

// Member
$route['member/(:num)/profile'] = 'member/profile/$1';

// Partner/Company
$route['partner/(:num)/job/(:num)'] = 'partner/job/$1/$2';
$route['partner/(:num)/profile'] = 'partner/profile/$1';

//$route['site/about-us'] = "about";
//$route['site/about-us/about-us'] = "about";
$route['site/(:any)/([a-z]+)'] = "intl/site/$1/$2";
$route['site/(:any)+'] = "intl/site/$1";

$route['about-us'] = "about";


/* End of file routes.php */
/* Location: ./application/config/routes.php */