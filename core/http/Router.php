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
	
	public function get($request, $path = null) {
		$this->bind($request, $path, 'GET');
	}
	
	public function post($request, $path = null) {
		$this->bind($request, $path, 'POST');
	}

	public function put($request, $path = null) {
		$this->bind($request, $path, 'PUT');
	}
	
	public function delete($request, $path = null) {
		$this->bind($request, $path, 'DELETE');
	}
	
	protected function bind($request, $path, $method) {
		if (is_null($path)) {
			if (is_array($request)) {
				$this->defineMany($request, $method);
			}
		} else {
			$this->define($request, $path, $method);
		}
	}
	
	/**
	 * A method for defining all routes at once.
	 * 
	 * @param associative array
	 */
	protected function defineMany($routes, $method = 'GET') {
		if (!is_array($routes)) {
			throw new InvalidArgumentException('routes was not an array: ' . vd($routes));
		}
		foreach ($routes as $request => $path) {
			$this->define($request, $path, $method);
		}
	}
	
	/**
	 * A method for binding a specific request to the given path.
	 * 
	 * @param  String
	 * @param  String
	 */
	protected function define($request, $path, $method) {
		if (!is_string($request)) {
			throw new InvalidArgumentException('request is not a string: ' . $request);
		}
		if (!is_string($path)) {
			throw new InvalidArgumentException('path is not a string: ' . $path);
		}
		
		$this->routes[$method][$request] = $path;
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
	public function getPath($request, $method = 'GET') {
		return $this->routes[$method][$request];
	}
	
}
