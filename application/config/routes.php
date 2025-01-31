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
$route['default_controller'] = 'admin_main/index';
$route['404_override'] = '';
$route['main/(:any)'] = "main/$1";

/*admin*/
$route['admin_main'] = 'admin_main/index';

$route['login'] = 'admin_main/login';
$route['go_home'] = 'admin_main/go_home';

$route['add_case'] = 'admin_main/add_case';

$route['add_new'] = 'Case_ci/new_case';

$route['submit_case_details'] = 'admin_main/submit_case_details';

$route['view_case_details/(:any)'] = 'admin_main/view_case_details/$1';

/*
 * delete case
 * */
$route['delete_case/(:any)'] = 'admin_main/delete_case/$1';

/*
 * case Hearing
 * */
$route['add_case_hearing'] = 'admin_main/add_case_hearing';
$route['add_case_hearing_details'] = 'admin_main/add_case_hearing_details';

$route['edit_case/(:any)'] = 'admin_main/case_detail/$1';

$route['add_hiba_nama'] = 'admin_main/add_hiba_nama';
$route['add_hiba_nama_details'] = 'admin_main/add_hiba_nama_details';

$route['list_hiba_nama'] = 'admin_main/list_hiba_nama';




/*
 * Case Images or Files
 * */

$route['load_case_images_view'] = 'admin_main/load_case_images_view';
$route['submit_case_images'] = 'admin_main/submit_case_images';



/*
 * Hiba Nama
 *
 * */

$route['add_new_hiba_nama'] = 'Property_ci/load_hiba_nama';
$route['add_hiba_nama_details'] = 'Property_ci/add_hiba_nama_details';

$route['list_hiba_nama'] = 'Property_ci/list_hiba_nama_details';

    // edit and update

$route['edit_hiba_nama/(:any)'] = 'Property_ci/edit_hiba_nama/$1';
$route['update_hiba_nama/(:any)'] = 'Property_ci/update_hiba_nama/$1';

















