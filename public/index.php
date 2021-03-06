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

// specifics routes

$router->add('', ['controller' => 'Home', 'action' => 'index', 'namespace' => 'Backoffice']);
$router->add('about', ['controller' => 'Statico', 'action' => 'about', 'namespace' => 'Frontend']);
$router->add('contact', ['controller' => 'Statico', 'action' => 'contact', 'namespace' => 'Frontend']);
$router->add('register', ['controller' => 'Statico', 'action' => 'register', 'namespace' => 'Frontend']);
$router->add('login', ['controller' => 'Statico', 'action' => 'login', 'namespace' => 'Frontend']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy', 'namespace' => 'Frontend']);



//frontend routes

$router->add('{post:[\w-]+}', ['controller' => 'Post', 'action' => 'view', 'namespace' => 'Frontend']);

$router->add('category/{category:[\w-]+}', ['controller' => 'Category', 'action' => 'view', 'namespace' => 'Frontend']);
$router->add('{controller}/{action}', ['namespace' => 'Frontend']);



//backoffice routes

$router->add('admin/{controller}/{action}', ['namespace' => 'Backoffice']);



    
$router->dispatch($_SERVER['QUERY_STRING']);
