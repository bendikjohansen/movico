<?php

/**
* Bootstraps the project by loading all necessary files.
*/

$config = require 'config.php';

require 'helpers.php';

require 'http/Router.php';
require '../routes.php';

require 'http/View.php';
require 'http/Controller.php';

require 'http/Request.php';

require 'http/RequestProcessor.php';
