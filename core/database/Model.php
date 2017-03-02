<?php

/**
 * The base Model class. This represents a table in the database.
 */

abstract class Model {
	
	/**
	 * @var string name of the table in the database
	 */
	protected $tableName;
	
	/**
	 * @var array the columns that can take user input
	 */
	protected $fillable = [];
	
	/**
	 * 
	 * @var PDO the connection to the database
	 */
	private $pdo;
	
	/**
	 * Makes a connection to the database.
	 */
	function __construct() {
		$this->pdo = Connection::make();
	}
	
	/**
	 * Saves the model, inserting it to the database.
	 * 
	 * @return void
	 */
	public function save() {
		$start = 'INSERT INTO ' . $this->tableName . '(';
		$columnNames = implode(', ', $this->fillable);
		$middle = ') VALUES (:';
		$columnValues = implode(', :', $this->fillable);
		$end = ');';
		
		$query = $start . $columnNames . $middle . $columnValues . $end;
		if ($statement = $this->pdo->prepare($query)) {
			$statement->execute($this->getValues());
		}
	}
	
	/**
	 * @return array associative array of keys and values of the table.
	 */
	protected function getValues() {
		$values = [];
		foreach ($this->fillable as $column) {
			$values[$column] = $this->$column;
		}
		return $values;
	}
	
}
