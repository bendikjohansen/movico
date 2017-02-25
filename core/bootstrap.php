<?php

/**
* Bootstraps the project, loading all necessary files.
* If a file should be loaded, append the require function to this file.
*/

global $config;
$config = require 'core/config.php';

require 'core/Router.php';
require 'routes.php';

require 'core/View.php';
require 'core/Controller.php';

require 'core/process_request.php';
