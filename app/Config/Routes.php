<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// rutas que requieren autenticación:
$routes->group('', ['filter' => 'AuthCheck'], static function ($routes) {
  $routes->get('/', 'Home::index');
  $routes->get('/dashboard', 'Dashboard::index');

  $routes->get('users-list', 'UserCrud::index');
  $routes->get('user-form', 'UserCrud::create');
  $routes->post('user-submit-form', 'UserCrud::store');
  $routes->get('user-edit/(:num)', 'UserCrud::edit/$1');
  $routes->post('user-update', 'UserCrud::update');
  $routes->get('user-delete/(:num)', 'UserCrud::delete/$1');

  $routes->get('municipios-list', 'MunicipioCrud::index');
  $routes->get('municipio-form', 'MunicipioCrud::create');
  $routes->post('municipio-submit-form', 'MunicipioCrud::store');
  $routes->get('municipio-edit/(:num)', 'MunicipioCrud::edit/$1');
  $routes->post('municipio-update', 'MunicipioCrud::update');
  $routes->get('municipio-delete/(:num)', 'MunicipioCrud::delete/$1');
});


// rutas que no requieren autenticación:
$routes->group('auth', static function ($routes) {
  $routes->get('login', 'Auth::login');
  $routes->get('logout', 'Auth::logout');
  $routes->get('register', 'Auth::register');

  $routes->post('registerUser', 'Auth::registerUser');
  $routes->post('loginUser', 'Auth::loginUser');
});

