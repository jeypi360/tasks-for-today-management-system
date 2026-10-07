<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::welcome');
$routes->get('/tasks', 'Pages::tasks');
$routes->get('/profile', 'Pages::profile');
$routes->get('/about', 'Pages::about');

$routes->get('/login', 'Pages::login');
$routes->post('/login', 'Pages::authenticate');
$routes->post('/logout', 'Pages::logout');

$routes->get('/tasks/new', 'Pages::newTask');
$routes->post('/tasks', 'Pages::createTask');
$routes->get('/tasks/(:num)/edit', 'Pages::editTask/$1');
$routes->post('/tasks/(:num)', 'Pages::updateTask/$1');
$routes->post('/tasks/(:num)/delete', 'Pages::archiveTask/$1');