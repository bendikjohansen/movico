<?php

/**
 * The router class is used to define where the semantic URLs should point. 
 */

class Router {
	
	protected $routes = [
		'GET' => [],
		'POST' => [],
		'PUT' => [],
		'DELETE' => []
	];
		
	/**
	 * A method for binding a specific request to the given path.
	 * 
	 * @param  String
	 * @param  String
	 */
	public function define($request, $path, $method = 'GET') {
		if (!is_string($request)) {
			throw new InvalidArgumentException('request is not a string: ' . $request);
		}
		if (!is_string($path)) {
			throw new InvalidArgumentException('path is not a string: ' . $path);
		}
		
		$this->routes[$method][$request] = $path;
	}
	
	/**
	 * A method for defining all routes at once.
	 * 
	 * @param associative array
	 */
	public function defineMany($routes, $method = 'GET') {
		foreach ($routes as $request => $path) {
			$this->define($request, $path, $method);
		}
	}
	
	/**
	 * Check whether the given url is binded to a path.
	 * 
	 * @param String
	 * @return whether the url is binded to a path.
	 */
	public function has($request, $method = 'GET') {
		return array_key_exists($request, $this->routes[$method]);
	}
	
	/**
	 * Finds route associated with request.
	 * 
	 * @return path binded to request.
	 */
	public function get($request, $method = 'GET') {
		return $this->routes[$method][$request];
	}
	
}
