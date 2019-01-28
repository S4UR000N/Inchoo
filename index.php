<?php

// Start Session
session_start();

// require autoloader
require "autoloader.php";

// Load Routes
$routes = require "Router/routes.php";

// Load Header
require "Layout/Header/header.php";

// Load Router and render Page or Error 404
require "Router/router.php";
