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
$routes->get('/', 'Home::index');
$routes->add('register', 'Auth::register');
$routes->add('login', 'Auth::login');
$routes->add('logout', 'Auth::logout');
$routes->add('about', 'Home::about');
$routes->add('terms-and-conditions', 'Home::termsAndConditions');
$routes->add('error', 'Home::error');
$routes->addRedirect('admin', 'admin/panel');

// Shop routes
$routes->group('shop', function ($routes) 
{
	$routes->add('/', 'Shop::index');
	$routes->add('addToCart', 'Shop::addToCart');
	$routes->add('product/(:any)', 'Shop::product/$1');
	$routes->add('(:any)', 'Shop::index/$1');
});

// User routes
$routes->group('user', function ($routes) 
{
	$routes->add('view-order/(:any)', 'User::order/$1');
	$routes->add('addresses/edit/(:any)', 'User::editAddress/$1');
});

// Admin routes
$routes->group('admin', function($routes)
{
		// Panel Route
    $routes->add('panel', 'Admin\Panel::index');

		// Order routes
    $routes->add('orders/view-all', 'Admin\Orders::viewAll');
    $routes->add('orders/view/(:any)', 'Admin\Orders::view/$1');

		// Customer routes
    $routes->add('customers/view/(:any)', 'Admin\Customers::view/$1');
		
		// Product routes
    $routes->add('product/create', 'Admin\Product::create');
    $routes->add('product/edit/(:any)', 'Admin\Product::edit/$1');
		
		// Sale routes
		$routes->add('sale/create/', 'Admin\Sale::create');
		$routes->add('sale/edit/(:any)', 'Admin\Sale::edit/$1');
		
		// Discount routes
		$routes->add('discount/create', 'Admin\Discount::create');
		
		// Newsletter routes
		$routes->add('newsletter/send', 'Admin\Newsletter::send');
	});


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}