<?php

/**
 * The Request class represents a request in the HTTP layer.
 */

class Request {
	
	public const GET = 'GET';
	public const POST = 'POST';
	public const PUT = 'PUT';
	public const DELETE = 'DELETE';
		
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
			$error_string = 'action must be a string: ' .$action;
			throw new InvalidArgumentException($error_string);
		}
		if (!is_string($method)) {
			$error_string = 'method must be a string: ' . $method;
			throw new InvalidArgumentException($error_string);
		}
		
		$this->action = $action;
		$this->method = strtoupper($method);
		
		$this->getData();
	}
	
	/**
	 * @return the request action
	 */
	public function getAction() {
		return $this->action;
	}
	
	/**
	 * @return the request method
	 */
	public function getMethod() {
		return $this->method;
	}
	
	protected function getData() {
		if ($this->method === self::POST) {
			foreach ($_POST as $key => $value) {
				$this->$key = $value;
			}
		}
	}
	
}
