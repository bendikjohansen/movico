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
		if (request_method() !== Request::$get) {
			throw new InvalidArgumentException('Request method expected to be GET: ' . request_method());
		}
		
		if ($data !== null) {
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					$$key = $value;
				}
			}
		}
		
		return require _public('views/' . $filename . '.view.php');
	}
	
	public static function POST($filename, $data = null) {
		if (request_method() !== Request::$post) {
			throw new InvalidArgumentException('Request method expected to be GET: ' . request_method());
		}
		
		return require _public('views/' . $filename . '.view.php');	
	}
}
