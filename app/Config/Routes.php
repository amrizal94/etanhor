<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
// $routes->add('/auth/index', 'Auth::index');
$routes->post('/auth', 'Auth::auth');
$routes->get('/auth', 'Auth');
$routes->get('/Auth', 'Auth');
$routes->add('/auth/(:any)', 'Auth::auth');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/Dashboard', 'Dashboard::index');
$routes->get('/ajuan', 'Ajuan::index');
$routes->get('/Ajuan', 'Ajuan::index');
$routes->get('/logout', 'Auth::logout');
$routes->get('/Logout', 'Auth::logout');
$routes->get('/User', 'User::index');
$routes->get('/user', 'User::index');

// polda
$routes->get('/Polda', 'Polda::index');
$routes->get('/polda', 'Polda::index');
$routes->post('/Polda/save', 'Polda::save');
$routes->delete('/polda/(:num)', 'Polda::delete/$1');

// polres
$routes->get('/Polres', 'Polres::index');
$routes->get('/polres', 'Polres::index');
$routes->post('/Polres/save', 'Polres::save');
$routes->delete('/polres/(:num)', 'Polres::delete/$1');

// polsek
$routes->get('/Polsek', 'Polsek::index');
$routes->get('/polsek', 'Polsek::index');
$routes->post('/Polsek/save', 'Polsek::save');
$routes->delete('/polsek/(:num)', 'Polsek::delete/$1');

$routes->get('/Polda/save', 'Auth');
$routes->get('/Polres/save', 'Auth');
$routes->get('/Polsek/save', 'Auth');
$routes->add('/(:any)', 'Auth');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
