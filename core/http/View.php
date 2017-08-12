<?php

/**
 * The View class handles the file of which data is rendered on.
 */

class View {
	
	/**
	 * Gets the given file, and passes along data to the view.
	 *
	 * @param String
	 * @param associative array
	 */
	public static function get(string $filename, array $data = null) {
		$data = $data ?? [];
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}
		
		unset($data);
		return require _view($filename . '.view.php');
	}
}
