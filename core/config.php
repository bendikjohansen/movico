<?php

/**
 * Configuration file for the project.
 */

return [
	
	'directory paths' => [
		'controllers' => __DIR__ . '/../controllers/',
		'public' => __DIR__ . '/../public/'
	],
	
	'maintenance' => [
		'active' => false
	],
	
	'special paths' => [
		'404' => '/404',
		'maintenance' => '/maintenance'
	]

];
