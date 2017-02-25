<?php

/**
 * All of the helper functions in the project. Some may be a short-hand way of
 * writing the code, others may be a safer way.
 */

/**
 * Prepends the path to the public folder.
 * 
 * @param  String
 * @return path to the public folder.
 */
function _public($path) {
	return $config['directory paths']['public'];
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
