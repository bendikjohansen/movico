<?php

/**
* Bootstraps the project by loading all necessary files.
*/

$config = require 'config.php';

require 'helpers.php';

require 'database/Connection.php';
require 'database/DB.php';
require 'database/Model.php';
require __DIR__ . '/../database/models.php';

require 'http/Router.php';
require __DIR__ . '/../routes.php';

require 'http/View.php';
require 'http/Controller.php';

require 'http/Request.php';

require 'http/RequestProcessor.php';
