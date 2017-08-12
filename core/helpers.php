<?php

/**
 * All of the helper functions in the framework.
 */

/**
 * Prepends the given path to the public folder path.
 * 
 * @param  string
 * @return path from the public folder.
 */
function _public(string $path) : string {
	global $config;
	return $config['directories']['public'] . $path;
}

/**
 * Prepends the given path to the views folder path.
 *
 * @param  string
 * @return path from the views folder.
 */
function _view(string $path) : string {
	global $config;
	return $config['directories']['views'] . $path;
}

/**
 * Checks whether the string has the given substrings.
 * @param  string $haystack the string to search
 * @param  string $needles  the strings to look for
 * @return bool whether the string has the given substrings
 */
function stringContains(string $haystack, string ...$needles) : bool {
	foreach ($needles as $needle) {
		if (strpos($haystack, $needle) === false) {
			return false;
		}
	}
	
	return true;
}

/**
 * @return whether the site is under maintenance
 */
function underMaintenance() : bool {
	global $config;
	return $config['maintenance']['active'];
}

/**
 * Gets the URI from the $_SERVER array.
 * 
 * @return string
 */
function uri() : string {
	return $_SERVER['REQUEST_URI'];
}

/**
 * Gets the request method from the $_SERVER array.
 * 
 * @return string
 */
function requestMethod() : string {
	return $_SERVER['REQUEST_METHOD'];
}

/**
 * Vardumps the data in a prettier format.
 * 
 * @param  mixed
 */
function vd($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

/**
 * Shorthand of the View::GET method.
 */
function view(string $filename, array $data = null) {
	return View::get($filename, $data);
}
