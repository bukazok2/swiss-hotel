<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Fetch', 'Fetch::index');
$routes->get('Hotels', 'HotelController::index');