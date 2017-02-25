<?php

/**
 * The entry point of the whole project.
 */

require __DIR__ . '/../core/bootstrap.php';

ProcessRequest::handle(new Request(uri(), request_method()), $routes);
