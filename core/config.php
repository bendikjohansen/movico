<?php

/**
 * Configuration file for the project.
 */

return [
	
	'directories' => [
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
