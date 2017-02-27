<?php

/**
 * The entry point of the whole framework.
 */

require __DIR__ . '/../core/bootstrap.php';

RequestProcessor::handle(new Request(uri(), requestMethod()), $routes);
