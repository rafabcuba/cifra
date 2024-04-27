<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// rutas que requieren autenticación:
$routes->group('', ['filter' => 'AuthCheck'], static function ($routes) {
  $routes->get('/', 'Home::index');
  $routes->get('/dashboard', 'Dashboard::index');
});


// rutas que no requieren autenticación:
$routes->group('auth', static function ($routes) {
  $routes->get('login', 'Auth::login');
  $routes->get('logout', 'Auth::logout');
  $routes->get('register', 'Auth::register');

  $routes->post('registerUser', 'Auth::registerUser');
  $routes->post('loginUser', 'Auth::loginUser');
});

