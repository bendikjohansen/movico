<?php

/**
 * Bind urls to controllers in this file.
 */

$routes = new Router;

$routes->get('/', 'HomeController@home');

/**
 * Routes underneath are considered special and should always have a controller-method.
 */

$routes->get([
	$config['special paths']['404'] => 'HomeController@notFound',
	$config['special paths']['maintenance'] => 'HomeController@maintenance'
]);
