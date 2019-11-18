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

$route['default_controller'] = "adminx";
$route['404_override'] = '';
$route['promo'] = "promo/index";
$route['create-new-promo'] = "promo/promonew";
$route['diskon'] = "promo/diskon";
$route['new-diskon'] = "promo/diskonnew";
$route['confirm-bayar']= "adminx/confirmBayar";
$route['confirm-trx']= "adminx/confirmTrx";
$route['cancelled-trx']= "adminx/cancelledTrx";
$route['finished-trx']= "adminx/finishedTrx";
$route['all-trx']= "adminx/allTrx";
$route['all-trx-kai']= "adminx/allTrxKAI";
$route['all-trx-pelni']= "adminx/allTrxPelni";
$route['all-trx-hotel']= "adminx/allTrxHotel";
$route['new-trx']= "adminx/index";
$route['konfirmasi-bayar'] = "adminx/confirmasiPembayaran";
//super admin
$route['superadmin']="superadminx";
$route['confirm_bayar']="superadminx/confirmBayar";
$route['confirm_trx']= "superadminx/confirmTrx";
$route['finished_trx']= "superadminx/finishedTrx";
$route['cancelled_trx']= "superadminx/cancelledTrx";
$route['all_trx']= "superadminx/allTrx";
$route['all_trx_kai']= "superadminx/allTrxKAI";
$route['all_trx_pelni']= "superadminx/allTrxPelni";
$route['all_trx_hotel']= "superadminx/allTrxHotel";
$route['new_trx']= "superadminx/index";
$route['konfirmasi_bayar'] = "superadminx/confirmasiPembayaran";
$route['alladmin'] = "superadminx/allMember";			//untuk superadmin
$route['addadmin'] = "superadminx/addAdminx";
$route['admin'] = "adminx/allAdmin";					//untuk admin
$route['updateadmin'] = "adminx/updateAdmin";
$route['updateprocess']="adminx/updateAdminProces";

/* End of file routes.php */
/* Location: ./application/config/routes.php */