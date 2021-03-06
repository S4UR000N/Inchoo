<?php

// if Request Exists Process it
if($_POST) {
	// exract Request data
	$route = $_POST['ajax'];

	// seperate Controller & Method
	$controller_method = explode(':', $route);
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

// else return false
else { echo 0; }
