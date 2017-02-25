<?php

/**
 * This class handles the file of which data is rendered on.
 */

class View {
	
	/**
	 * A simple GET method. Passes given data into the file.
	 *
	 * @param String
	 * @param associative array
	 */
	public static function GET($filename, $data = null) {
		global $config;
		return require $config['directory paths']['views'] . $filename . '.view.php';
	}
	
}
