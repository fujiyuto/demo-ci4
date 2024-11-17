<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->match(['get', 'post'], 'news/create', 'News::create');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->get('users', 'UserController::index');
    $routes->get('users/(:num)', 'UserController::show/$1');
    $routes->post('users', 'UserController::create');
    $routes->patch('users/(:num)', 'UserController::edit/$1');
    $routes->delete('users/(:num)', 'UserController::delete/$1');
});

// $routes->get('api/users', 'Api\UserController::index');

$routes->get('(:any)', 'Pages::showme/$1');