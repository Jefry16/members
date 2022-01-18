<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');
session_start();

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);

$router->add('ccb/admin', ['controller' => 'Inicio', 'action' => 'index', 'namespace' => 'Admin']);


$router->add('login', ['controller' => 'Login', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('{controller}');
$router->add('{controller}/{action}');

//Admin routes


$router->add('ccb/admin/{controller}', ['namespace' => 'Admin']);
$router->add('ccb/admin/{controller}/{action}', ['namespace' => 'Admin']);

    
$router->dispatch($_SERVER['QUERY_STRING']);
