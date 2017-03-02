<?php

/**
 * Establishes a connection to the database.
 */

class Connection {
	
	public static function make() {
		$db = Connection::getInfo();
		
		$pdo = new PDO(
			$db['driver'] .
			':host=' . $db['host'] .
			';port=' . $db['port'] .
			';dbname=' . $db['dbname'],
			$db['username'],
			$db['password']
		);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		return $pdo;
	}
	
	protected static function getInfo() {
		$dbInfo = parse_ini_file(__DIR__ . '/../../env.ini', true)['database'];
		return $dbInfo;
	}
	
}
