<?php

/**
 * The router class is used to define where the semantics URLs should point. 
 * Do not touch this class.
 */

class Router {
	
	protected $routes = [];
	
	/**
	 * A method for defining all routes at once.
	 * 
	 * @param associative array
	 */
	public function defineMany($routes) {
		foreach ($routes as $request => $path) {
			$this->validateRequest($request);
			$this->validatePath($path);
		}
		
		$this->routes = array_merge($this->routes, $routes);
	}
	
	/**
	 * A method for binding a specific request to the given path.
	 * 
	 * @param  String
	 * @param  String
	 */
	public function define($request, $path) {
		$this->validateRequest($request);
		$this->validatePath($path);
		
		$this->routes[$request] = $path;
	}
	
	/**
	 * Check whether the given url is binded to a path.
	 * 
	 * @param String
	 * @return whether the url is binded to a path.
	 */
	public function has($request) {
		return array_key_exists($request, $this->routes);
	}
	
	/**
	 * Finds route associated with request.
	 * 
	 * @return path binded to request.
	 */
	public function get($request) {
		return $this->routes[$request];
	}
	
	/**
	 * Validate the path
	 * 
	 * @param String
	 * @return whether the path is valid
	 */
	private function validatePath($path) {
		if (!is_string($path)) {
			throw new InvalidArgumentException('path is not a string: ' . $path);
		}
	}
	
	/**
	 * Validate the request
	 * 
	 * @param String
	 * @return whether the request is valid.
	 */
	private function validateRequest($request) {
		if (!is_string($request)) {
			throw new InvalidArgumentException('request is not a string: ' . $request);
		}
	}
}
