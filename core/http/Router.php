<?php

/**
 * The Router class is used to register web routes.
 */

class Router {
	
	protected $routes = [
		'GET' => [],
		'POST' => [],
		'PUT' => [],
		'DELETE' => []
	];
	
	/**
	 * Defines a callback for the given URI as a GET request.
	 * 
	 * @param  String $uri
	 * @param  String $callback
	 */
	public function get($uri, $callback = null) {
		$this->define($uri, $callback, 'GET');
	}
	
	/**
	 * Defines a callback for the given URI as a POST request.
	 * 
	 * @param  String $uri
	 * @param  String $callback
	 */
	public function post($uri, $callback = null) {
		$this->define($uri, $callback, 'POST');
	}

	/**
	 * Defines a callback for the given URI as a PUT request.
	 * 
	 * @param  String $uri
	 * @param  String $callback
	 */
	public function put($uri, $callback = null) {
		$this->define($uri, $callback, 'PUT');
	}
	
	/**
	 * Defines a callback for the given URI as a DELETE request.
	 * 
	 * @param  String $uri
	 * @param  String $callback
	 */
	public function delete($uri, $callback = null) {
		$this->define($uri, $callback, 'DELETE');
	}
	
	protected function define($uri, $callback, $method) {
		if (is_null($callback)) {
			if (is_array($uri)) {
				$this->defineMany($uri, $method);
			}
		} else {
			$this->bind($uri, $callback, $method);
		}
	}
	
	protected function defineMany($routes, $method = 'GET') {
		foreach ($routes as $uri => $callback) {
			$this->define($uri, $callback, $method);
		}
	}
	
	protected function bind($uri, $callback, $method) {
		if (!is_string($uri)) {
			throw new InvalidArgumentException('uri is not a string: ' . $uri);
		}
		
		$this->routes[$method][$uri] = $callback;
	}
	
	/**
	 * Check whether the given URI is bound to a callback.
	 * 
	 * @param String
	 * @return whether the URI is binded to a callback.
	 */
	public function has($uri, $method = 'GET') {
		return array_key_exists($uri, $this->routes[$method]);
	}
	
	/**
	 * @return callback bound to URI.
	 */
	public function getCallback($uri, $method = 'GET') {
		return $this->routes[$method][$uri];
	}
	
}
