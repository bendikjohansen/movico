<?php

/**
 * Bind urls to controllers in this file.
 */

$routes = new Router;

$routes->defineMany([
	'/' => 'HomeController@home',
]);

/**
 * Routes underneath are considered special and should always have a controller-method.
 */
$sp = $config['special paths'];

$routes->define($sp['404'], 'HomeController@notFound');
$routes->define($sp['maintenance'], 'HomeController@maintenance');

unset($sp);
