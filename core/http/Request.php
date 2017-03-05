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
	function __construct(string $action, string $method) {
		$this->action = $action;
		$this->method = rawurldecode(strtoupper($method));
		
		$this->getData();
	}
	
	/**
	 * @return the request action
	 */
	public function getAction() : string {
		return $this->action;
	}
	
	/**
	 * @return the request method
	 */
	public function getMethod() : string {
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
