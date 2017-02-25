<?php

/**
 * ProcessRequest processes each request and addresses them accordingly.
 */

class ProcessRequest {
	
	/**
	 * Processes the request. Firstly, it handles maintenance, and finally
	 * it handles rest of the request.
	 * 
	 * @param  Request $request 
	 * @param  Router  $routes  
	 */
	public static function handle(Request $request, Router $routes) {
		$action = $request->getAction();
		$route_exists = $routes->has($action);
		
		// Handles maintenance
		if (under_maintenance()) {
			$maintenance = get_special_path('maintenance');
			if ($maintenance !== $action) {
				$action = $maintenance;
			}
		} else {
			if ($action === get_special_path('maintenance')) {
				$route_exists = false;
			}
		}
		
		// Handles request
		if ($route_exists) {
			$controller_name = explode('@', $routes->get($action))[0];
			$method_name = explode('@', $routes->get($action))[1];
			
			ProcessRequest::direct($controller_name, $method_name);
		} else {
			$notfound = get_special_path('404');
			die(ProcessRequest::handle(new Request($notfound, $request->getMethod()), $routes));
		}
	}
	
	protected static function direct($controller_name, $method_name) {
		if (($controller = ProcessRequest::getController($controller_name)) !== null) {
			$method = $controller->$method_name();
			if (function_exists($method) && is_callable($method)) {
				die($method());
			}
		} else {
			die ('could not find controller: ' . $controller_name);
		}
	}
	
	protected static function getController($controller_name) {
		global $config;
		$controller_file = $config['directory paths']['controllers'] . $controller_name . '.php';
		if (file_exists($controller_file)) {
			require $controller_file;
			
			if (class_exists($controller_name)) {
				return new $controller_name;
			}
		}
		return null;
	}
	
}
