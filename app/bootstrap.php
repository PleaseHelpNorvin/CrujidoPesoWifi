<?php
// bootstrap.php

// Load composer autoload if using any libraries
// require __DIR__ . '/../vendor/autoload.php';

// Load helpers
require __DIR__ . '/helpers/functions.php';

// Load config
$config = require __DIR__ . '/../config/config.php';

// Load database connection
require __DIR__ . '/../config/database.php';

// Initialize router (your custom Router class)
$router = new Core\Router();

// Load routes
require __DIR__ . '/../routes/web.php';
require __DIR__ . '/../routes/api.php';
