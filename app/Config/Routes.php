<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\SuperAdmin\Superadmin_Controller;
use App\Controllers\SuperAdmin\Superadmin_action_Controller;

/**
 * @var RouteCollection $routes
*/

helper('routes');

$routes->get('/', 'Home::login_page', ['filter' => 'Authenticate']);
$routes->post('login', 'Home::login');
$routes->post('create-account', 'Home::create_account');
$routes->post('forgot-password', 'Home::forgot_password');
$routes->post('check-email', 'Home::checkEmail');
$routes->post('check-username', 'Home::checkUsername');
$routes->get('aktifkan-akun/(:any)/(:any)', 'Home::aktifkan_akun/$1/$2');
$routes->get('ubah-password/(:any)', 'Home::v_forgot_password/$1');
$routes->post('ubah-passwords/(:any)', 'Home::save_forgot_password/$1');
$routes->get('aktivasi-ulang/(:any)/(:any)', 'Home::aktivasi_kembali/$1/$2');
$routes->get('reactivate-account-email/(:any)/(:any)', 'Home::aktivasiulang/$1/$2');
$routes->get('sign-out', 'Home::logout', ['as' => 'logout']);

$routes->group('4', ['namespace' => 'App\Controllers\SuperAdmin'], ['fiter' => 'CheckSession'], function ($routes) {
  
  require(__DIR__ . "/_extend_routes/superadmin.php");
  // // sidebar menu dashboard
 
});