<?php

/**
 * ProcessRequest processes each request and addresses them accordingly.
 */

class RequestProcessor {
	
	/**
	 * Handles the request.
	 * 
	 * @param  Request $request
	 * @param  Router  $routes
	 */
	public static function handle(Request $request, Router $routes) {
		
		if (underMaintenance()) {
			// Direct to maintenance
			return view('maintenance');
		} else if ($routes->has($request->getAction())) {
			// Direct as planned		
			self::direct($request, $routes);
		} else {
			// Direct to 404
			return view('404');
		}
		
	}
	
	protected static function direct(Request $request, Router $routes) {
		$requestAction = $request->getAction();
		$requestMethod = $request->getMethod();
		$currentRoute = $routes->currentRoute;
		
		$callback = $routes->prepareCallback($request);
		$variables = $routes->getUriVariables($requestAction, $currentRoute);
		foreach ($variables as $key => $value) {
			$request->$key = $value;
		}
		
		if (is_callable($callback)) {
			$reflector = new ReflectionFunction($callback);
			
			if ($reflector->getNumberOfParameters() === 0) {
				$callback();
			} else {
				$callback($request);
			}
			
		} else {
			$callback = explode('@', $callback);
			
			$controller = self::findController($callback[0]);
			$method = $callback[1];
			
			if (method_exists($controller, $method)) {
				$reflector = new ReflectionMethod($controller, $method);
				
				if ($reflector->getNumberOfParameters() === 0) {
					$controller->$method();	
				} else {
					$controller->$method($request);
				}
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
