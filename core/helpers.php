<?php

/**
 * All of the helper functions in the project. Some may be a short-hand way of
 * writing the code, others may be a safer way.
 */

/**
 * Gets the URI for the given, special path.
 */
function get_special_path($path) {
	global $config;
	return $config['special paths'][$path];
}

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
function under_maintenance() {
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
function request_method() {
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
	View::get($filename, $data);
}
