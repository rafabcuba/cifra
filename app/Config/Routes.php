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

  $routes->get('tipos-list', 'TipoCrud::index');
  $routes->get('tipo-form', 'TipoCrud::create');
  $routes->post('tipo-submit-form', 'TipoCrud::store');
  $routes->get('tipo-edit/(:num)', 'TipoCrud::edit/$1');
  $routes->post('tipo-update', 'TipoCrud::update');
  $routes->get('tipo-delete/(:num)', 'TipoCrud::delete/$1');

  $routes->get('formularios-list', 'FormularioCrud::index');
  $routes->get('formulario-form', 'FormularioCrud::create');
  $routes->post('formulario-submit-form', 'FormularioCrud::store');
  $routes->get('formulario-edit/(:num)', 'FormularioCrud::edit/$1');
  $routes->post('formulario-update', 'FormularioCrud::update');
  $routes->get('formulario-delete/(:num)', 'FormularioCrud::delete/$1');

  $routes->get('entidades-list', 'EntidadCrud::index');
  $routes->get('entidad-form', 'EntidadCrud::create');
  $routes->post('entidad-submit-form', 'EntidadCrud::store');
  $routes->get('entidad-edit/(:num)', 'EntidadCrud::edit/$1');
  $routes->post('entidad-update', 'EntidadCrud::update');
  $routes->get('entidad-delete/(:num)', 'EntidadCrud::delete/$1');

  $routes->get('disciplinas-list', 'DisciplinaCrud::index');
  $routes->get('disciplina-form', 'DisciplinaCrud::create');
  $routes->post('disciplina-submit-form', 'DisciplinaCrud::store');
  $routes->get('disciplina-edit/(:num)', 'DisciplinaCrud::edit/$1');
  $routes->post('disciplina-update', 'DisciplinaCrud::update');
  $routes->get('disciplina-delete/(:num)', 'DisciplinaCrud::delete/$1');
});


// rutas que no requieren autenticación:
$routes->group('auth', static function ($routes) {
  $routes->get('login', 'Auth::login');
  $routes->get('logout', 'Auth::logout');
  $routes->get('register', 'Auth::register');

  $routes->post('registerUser', 'Auth::registerUser');
  $routes->post('loginUser', 'Auth::loginUser');
});

