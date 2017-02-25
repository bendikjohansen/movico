<?php

/**
* Bootstraps the project, loading all necessary files.
* If a file should be loaded, append the require function to this file.
*/

$config = require 'config.php';

require 'helpers.php';

require 'Request.php';
require 'Router.php';
require '../routes.php';

require 'View.php';
require 'Controller.php';

require 'ProcessRequest.php';
