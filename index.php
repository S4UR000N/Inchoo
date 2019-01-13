<?php

// Start Session
session_start();

// require autoloader
require "autoloader.php";

// Load Routes
$routes = require "router/routes.php";

// Load Router and render Page or Error 404
require "router/router.php";
