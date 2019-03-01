<?php

// Start Session
session_start();

// require autoloader
require "autoloader.php";

// Load Routes
$routes = require "Router/routes.php";

// Get POST key to determine type of request
function array_key_first(array $array) { if (count($array)) { reset($array); return key($array); } return null; }

// if is POST and is AJAX Request: Load AJAX Router
// else: Load Header & Page
if($_POST && array_key_first($_POST) == 'ajax') {
	// Load AJAX Router
	require "Router/ajaxrouter.php";
}
else {
	// Load Header
	require "Layout/Header/header.php";

	// Load Router and render Page or Error 404
	require "Router/router.php";
}
