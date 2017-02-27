<?php

/**
 * The View class handles the file of which data is rendered on.
 */

class View {
	
	/**
	 * Gets the given file, and passes along some data to the view.
	 *
	 * @param String
	 * @param associative array
	 */
	public static function get($filename, $data) {
		if (is_null($data)) {
			$data = [];
		}
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}
		
		unset($data);
		return require _public('views/' . $filename . '.view.php');
	}
}
