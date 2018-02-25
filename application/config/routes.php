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
$route['default_controller'] = 'welcome';
$route['404_override'] = 'errors/error_404';
$route['translate_uri_dashes'] = FALSE;

/* Not login user */
$route['page/help'] = 'welcome/page/help';
$route['page/fees'] = 'welcome/page/fees';
$route['page/developer'] = 'welcome/page/developer';
$route['page/mobile'] = 'welcome/page/mobile';
$route['page/personal'] = 'welcome/page/personal';
$route['page/business'] = 'welcome/page/business';
$route['user'] = 'user';
$route['signup/business/(:any)'] = 'user/business/$1';
$route['signup'] = 'user/selectaccount';
$route['signup/personal'] = 'user/personal';
$route['signup/business'] = 'user/business';
$route['myaccount/forgot/(:any)'] = 'user/forgot/$1';
$route['myaccount/forgot'] = 'user/forgot/look';
$route['myaccount/forgot/comfirm'] = 'user/forgot/comfirm';

/* Login user */
$route['myaccount'] = 'myaccount';
$route['myaccount/signin'] = 'user/signin';
$route['myaccount/logout'] = 'user/logout';
$route['business/logout'] = 'user/logout';
$route['busines'] = 'business';
$route['business/wallet'] = 'business/wallet';
$route['business/wallet_add'] = 'business/wallet_add';
$route['business/activity'] = 'business/activity';
$route['business/transfer'] = 'business/transfer';
$route['business/transfer/send'] = 'business/transfer_method/send';
$route['business/transfer/send/complete'] = 'business/transfer_method/complete';
$route['business/transfer/repeat'] = 'business/transfer_method/repeat';
$route['business/transfer/request'] = 'business/transfer_method/request';
$route['business/transfer/send/cancel'] = 'business/transfer_method/cancel';
$route['business/settings'] = 'business/settings/account';

$route['myaccount/wallet'] = 'myaccount/wallet';
$route['myaccount/wallet_add'] = 'myaccount/wallet_add';
$route['myaccount/activity'] = 'myaccount/activity';
$route['myaccount/transfer'] = 'myaccount/transfer';
$route['myaccount/transfer/send'] = 'myaccount/transfer_method/send';
$route['myaccount/transfer/send/complete'] = 'myaccount/transfer_method/complete';
$route['myaccount/transfer/repeat'] = 'myaccount/transfer_method/repeat';
$route['myaccount/transfer/request'] = 'myaccount/transfer_method/request';
$route['myaccount/transfer/send/cancel'] = 'myaccount/transfer_method/cancel';
$route['myaccount/settings'] = 'myaccount/settings/account';
$route['fund'] = 'fund';
$route['checkout'] = 'checkout';
$route['checkout/bank'] = 'BankCheckout';

$route['admin/transaction'] = 'admin/search_transaction';
$route['admin/transaction/(:num)'] = 'admin/search_transaction/$1';

$route['admin/pending'] = 'admin/pending_transaction';
$route['admin/pending/deposit'] = 'admin/pending_transaction/deposit';
$route['admin/pending/deposit/(:num)'] = 'admin/pending_transaction/deposit/$1';
$route['admin/pending/withdraw'] = 'admin/pending_transaction/withdraw';
$route['admin/pending/withdraw/(:num)'] = 'admin/pending_transaction/withdraw/$1';
$route['pay/(:any)'] = 'checkout/pay_link/$1';
$route['donate/(:any)'] = 'donation/pay_link/$1';

/* Admin */
//$route['admin'] = 'admin/setting';
$route['admin/setting'] = 'admin/setting';
$route['admin/adduser/select'] = 'admin/selectaccount';
$route['admin/adduser/personal'] = 'admin/addpersonal';
$route['admin/adduser/business'] = 'admin/addbusiness';
$route['admin/manage'] = 'admin/manage';
$route['admin/profile'] = 'admin/profile';
$route['admin/profile/delete'] = 'admin/delete_user';