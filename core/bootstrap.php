<?php

/**
* Bootstraps the project, loading all necessary files.
* If a file should be loaded, append the require function to this file.
*/

$config = require 'config.php';

require 'helpers.php';

require 'http/Router.php';
require '../routes.php';

require 'http/View.php';
require 'http/Controller.php';

require 'http/Request.php';

require 'http/ProcessRequest.php';
