<?php

/**
 * All of the helper functions in the framework.
 */

/**
 * Prepends the path to the public folder.
 * 
 * @param  String
 * @return path to the public folder.
 */
function _public($path) {
	global $config;
	return $config['directories']['public'] . $path;
}

/**
 * @return whether the site is under maintenance
 */
function underMaintenance() {
	global $config;
	return $config['maintenance']['active'];
}

/**
 * Gets the URI from the $_SERVER array.
 * 
 * @return String
 */
function uri() {
	return $_SERVER['REQUEST_URI'];
}

/**
 * Gets the request method from the $_SERVER array.
 * 
 * @return String
 */
function requestMethod() {
	return $_SERVER['REQUEST_METHOD'];
}

/**
 * Vardumps the data in a prettier format.
 * 
 * @param  array
 */
function vd($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

/**
 * Shorthand of the View::GET method.
 */
function view($filename, $data = null) {
	return View::get($filename, $data);
}
