<?php

/**
 * This handles the request, and directs the client
 * to the controller and calls the given method.
 */

$request = $_SERVER['REQUEST_URI'];

if ($routes->has($request)) {
	$controller_name = explode('@', $routes->get($request))[0];
	$method_name = explode('@', $routes->get($request))[1];
	
	$controller_file = $config['directory paths']['controllers'] . $controller_name . '.php';
	if (file_exists($controller_file)) {
		require $controller_file;
		
		if (class_exists($controller_name)) {
			$controller = new $controller_name;
			
			$method = $controller->$method_name();
			if (function_exists($method) && is_callable($method)) {
				$method();
			}
		}
	}
} else {
	header('Location: /404');
}
