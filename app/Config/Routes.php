<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Home::index');


// Rutas para BCP QR

$routes->get('/', 'Bcpqr::index');

$routes->get('bcpqr/create', 'Bcpqr::create');
$routes->post('bcpqr/store', 'Bcpqr::store');

$routes->get('bcpqr/edit/(:num)', 'Bcpqr::edit/$1');
$routes->post('bcpqr/update/(:num)', 'Bcpqr::update/$1');

$routes->get('bcpqr/delete/(:num)', 'Bcpqr::delete/$1');

$routes->get('bcpqr/qr', 'Bcpqr::qr');
$routes->post('bcpqr/qr	', 'Bcpqr::qr');

// Rutas para BCP QR

/* $routes->resource('bnbqr');

$routes->get('(:any)', 'Bnbqr::index/$1'); */


$routes->get('/', 'Bnbqr::index');

$routes->get('bnbqr/create', 'Bnbqr::create');
$routes->post('bnbqr/store', 'Bnbqr::store');

$routes->get('bnbqr/edit/(:num)', 'Bnbqr::edit/$1');
$routes->post('bnbqr/update/(:num)', 'Bnbqr::update/$1');

$routes->get('bnbqr/delete/(:num)', 'Bnbqr::delete/$1');

$routes->get('bnbqr/qr', 'Bnbqr::qr');
$routes->post('bnbqr/qr	', 'Bnbqr::qr');

$routes->get('bnbqr/new', 'Bnbqr::new');
$routes->post('bnbqr/new	', 'Bnbqr::new');

$routes->get('bnbqr/generateqr', 'Bnbqr::generateqr');
$routes->post('bnbqr/generateqr	', 'Bnbqr::generateqr');


//

$routes->get('/', 'Atc::index');

$routes->get('atc/create', 'Atc::create');

//

$routes->get('/', 'Transferencia::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
