<?php

/**
 * Bind urls to controllers in this file.
 */

$routes = new Router;

$routes->defineMany([
	'/' => 'HomeController@home',
]);

$routes->define($config['special routes']['404'],			'HomeController@notFound');
$routes->define($config['special routes']['maintenance'],	'HomeController@maintenance');
