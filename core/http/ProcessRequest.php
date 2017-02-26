<?php

/**
 * ProcessRequest processes each request and addresses them accordingly.
 */

class ProcessRequest {
	
	/**
	 * Handles the request.
	 * 
	 * @param  Request $request
	 * @param  Router  $routes
	 */
	public static function handle(Request $request, Router $routes) {
		
		if (under_maintenance()) {
			// Direct to maintenance
			return view('maintenance');
		}
		
		if ($routes->has($request->getAction())) {
			// Direct as planned		
			self::direct($request, $routes);
		} else {
			// Direct to 404
			return view('404');
		}
		
	}
	
	protected static function direct(Request $request, Router $routes) {
		$request_action = $request->getAction();
		$request_method = $request->getMethod();
		
		$callback = $routes->getCallback($request_action, $request_method);
		
		if (is_callable($callback)) {
			$reflection = new ReflectionFunction($callback);
			
			if ($reflection->getNumberOfParameters() === 0) {
				$callback();
			} else {
				$callback($request);
			}
			
		} else {
			$callback = explode('@', $callback);
			
			$controller = self::findController($callback[0]);
			$method = $callback[1];
			
			if (method_exists($controller, $method)) {
				$controller->$method();
			}
			
		}
		
	}
	
	protected static function findController($controller) {
		global $config;
		$controller_dir = $config['directories']['controllers'];
		
		$controller_file = $controller_dir . $controller . '.php';
		
		if (file_exists($controller_file)) {
			require $controller_file;
			
			if (class_exists($controller)) {
				return new $controller;
			}
		}
		
		return null;
	}
	
}
