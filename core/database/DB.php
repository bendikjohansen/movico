<?php

class DB {
	
	protected static $instance = null;
	protected static $query = '';
	
	/**
	 * Builds a query to be executed.
	 * 
	 * @param  string $query a sql query
	 * @return DB          self
	 */
	public static function query($query) {
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
	 * @return DB          self
	 */
	public static function select(...$columns) {
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
	 * @return DB        self
	 */
	public function from($table) {
		self::$query .= ' FROM ' . $table;
		return $this;
	}
	
	/**
	 * Adds a condition to the query.
	 * 
	 * @param   $condition string
	 * @return DB            self
	 */
	public function where($condition) {
		self::$query .= ' WHERE ' . $condition;
		return $this;
	}
	
	/**
	 * Gets the first row that matches the conditions.
	 * 
	 * @return array a row of data from the database.
	 */
	public function get() {
		$statement = $this->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Gets all of the rows that matches the conditions.
	 * 
	 * @return array rows of data from the database
	 */
	public function all() {
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
