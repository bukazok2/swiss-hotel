<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Fetch', 'Fetch::index');
$routes->get('UpdateCache', 'Fetch::updateCache');
$routes->get('Hotels', 'HotelController::index');
$routes->get('Countries', 'CountriesController::index');
$routes->get('Cities', 'CitiesController::index');