<?php

class DB {
	
	protected static $instance = null;
	protected static $query = '';
	
	/**
	 * Builds a query to be executed.
	 * 
	 * @param  string $query a sql query
	 * @return DB
	 */
	public static function query(string $query) : DB {
		if (self::$instance === null) {
			self::$instance = new self;
		}
		self::$query = $query;
		return self::$instance;
	}
	
	/**
	 * Selects the given columns.
	 * 
	 * @param  array $columns name of the columns in the database table
	 * @return DB
	 */
	public static function select(string ...$columns) : DB {
		if (self::$instance === null) {
			self::$instance = new self;
		}
		self::$query = 'SELECT ' . implode(', ', $columns);
		return self::$instance;
	}
	
	/**
	 * Selects columns from the given table.
	 * 
	 * @param  string $table name of the table in the database
	 * @return DB
	 */
	public function from(string $table) : DB {
		self::$query .= ' FROM ' . $table;
		return $this;
	}
	
	/**
	 * Adds a condition to the query.
	 * 
	 * @param   $condition string
	 * @return DB
	 */
	public function where(string $condition) : DB {
		self::$query .= ' WHERE ' . $condition;
		return $this;
	}
	
	/**
	 * Continues a condition, requiring the given condition to be true.
	 * 
	 * @param  string $condition 
	 * @return DB
	 */
	public function and(string $condition) : DB {
		self::$query .= ' AND ' . $condition;
		return $this;
	}
	
	/**
	 * Continues a condition, requiring either 
	 * ones of the conditions to be true.
	 * 
	 * @param  string $condition
	 * @return DB
	 */
	public function or(string $condition) : DB {
		self::$query .= ' OR ' . $condition;
		return $this;
	}
	
	/**
	 * Sort the output of the statement.
	 * 
	 * @param  string $column
	 * @return DB
	 */
	public function orderBy(string $column) : DB {
		self::$query .= ' ORDER BY ' . $condition;
		return $this;
	}
	
	/**
	 * Sorts by descending instead of ascending.
	 * @return DB
	 */
	public function desc() : DB {
		self::$query .= ' DESC';
		return $this;
	}
	
	/**
	 * Gets the first row that matches the conditions.
	 * 
	 * @return array a row of data from the database.
	 */
	public function get() : array {
		$statement = $this->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Gets all of the rows that matches the conditions.
	 * 
	 * @return array rows of data from the database
	 */
	public function all() : array {
		$statement = $this->execute();
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Executes the query.
	 * 
	 * @return mixed
	 */
	public function execute() {
		$pdo = Connection::make();
		$statement = $pdo->prepare(self::$query);
		$statement->execute();
		return $statement;
	}
	
}
