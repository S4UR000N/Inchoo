<?php

// Error 404 as Default => "route does not exist"
$route = false;

// check if route exist
foreach($routes as $url => $blank) { if($url == $_SERVER['REQUEST_URI']) { $route = $url; } }

// Render 404
if(!$route) { echo "<h1>Error 404</h1>"; }

// Render Page
else {
	// seperate Controller & Method
	$controller_method = explode(':', $routes[$route]);
	$controller = $controller_method[0];
	$method = $controller_method[1];

	// fullfill path
	$classname = $controller;
	if(strpos($classname, 'Controller') !== false)  { $classname = 'Controller\\' . $classname; }

	// make instance of class
	$controller = new $classname;

	// run method
	$controller->$method();
}
