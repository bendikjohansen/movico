<?php

/**
 * The Request class handles the uri, as well as any validation of it.
 */

class Request {
	
	public static $get = 'GET';
	public static $post = 'POST';
	public static $put = 'PUT';
	public static $delete = 'DELETE';
		
	protected $action;
	protected $method;
	
	/**
	 * Constructs a Request. Validates the given agruments.
	 * 
	 * @param String $action 
	 * @param String $method
	 */
	function __construct($action, $method) {
		if (!is_string($action)) {
			throw new InvalidArgumentException('action must be a string: ' . $action);
		}
		if (!is_string($method)) {
			throw new InvalidArgumentException('method must be a string: ' . $method);
		}
		$method = strtoupper($method);
		$this->validateMethod($method);
		
		$this->action = $action;
		$this->method = $method;
	}
	
	public function getAction() {
		return $this->action;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
	/**
	 * Checks if the method is a get, post, put or delete method.
	 * 
	 * @param  string $method
	 * @return whether the method is valid
	 */
	private function validateMethod($method) {
		return 
		$method !== self::$get &&
		$method !== self::$post &&
		$method !== self::$put &&
		$method !== self::$delete;
	}
}
