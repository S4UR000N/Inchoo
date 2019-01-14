<?php
spl_autoload_register(function ($classname) {

		// auto fullfill path
		//if(strpos($classname, 'Controller') !== false)  { $classname = 'Controller\\' . $classname; }
		//if(strpos($classname, 'Model') !== false)  { $classname = 'Model\\' . $classname; }

    $file = __DIR__ . '/' . 'src' . '/'. $classname . '.php';
    $file = str_replace('\\', '/', $file);
		$file = str_replace('router', 'src', $file);

    if (file_exists($file)) { require_once($file); }
		//require $file;
		//die("<br>RIP");
});
