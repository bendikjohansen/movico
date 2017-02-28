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
			$error = 'uri is not a string: ' . $uri;
			throw new InvalidArgumentException($error);
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
		foreach (array_keys($this->routes[$method]) as $route) {
			if ($this->matchUri($uri, $route)) {
				$this->currentRoute = $route;
				return true;
			}
		}
		return false;
	}
	
	/**
	 * @return callback bound to URI.
	 */
	public function prepareCallback(Request $request) {
		$requestMethod = $request->getMethod();
		$route = $this->currentRoute;
		return $this->routes[$requestMethod][$route];
	}
	
	protected function matchUri($uri, $route) {
		$uri = trim($uri, '/');
		$route = trim($route, '/');
		
		$uriSize = sizeof(explode('/', $uri));
		$routeSize = sizeof(explode('/', $route));
		if ($uriSize !== $routeSize) {
			return false;
		}
		if ($uri === $route) {
			return true;
		}
		if (!is_null($uriSize)) {
			if (!stringContains($route, '{', '}')) {
				if ($uri !== $route) {
					return false;
				}
			}
		}
		$match = true;
		$this->iterateUriParts($uri, $route,
		function($uriPart, $routePart) use(&$match) {
			if (!stringContains($routePart, '{', '}')) {
				if ($uriPart !== $routePart) {
					$match = false;
				}
			}
		});
		
		return $match;
	}
	
	/**
	 * Gets any variables in the URL
	 * @param  string $uri   
	 * @param  string $route 
	 * @return associative array        keys and values for the variables
	 */
	public function getUriVariables($uri, $route) {
		$values = [];
		
		$this->iterateUriParts($uri, $route,
		function($uriPart, $routePart) use(&$values) {
			if (stringContains($routePart, '{', '}')) {
				$end = strlen($routePart) - 2;
				$key = substr($routePart, 1, $end);
				
				$values[$key] = $uriPart;
			}
		});
		
		return $values;
	}
	
	protected function iterateUriParts($uri, $route, $callback) {
		$uri = trim($uri, '/');
		$route = trim($route, '/');
		$uriParts = explode('/', $uri);
		$routeParts = explode('/', $route);
		$uriSize = sizeof($uriParts);
		$routeSize = sizeof($routeParts);
		
		for ($i = 0; $i < min($uriSize, $routeSize); $i++) {
			$callback($uriParts[$i], $routeParts[$i]);
		}
	}
}
