<?php
spl_autoload_register(function ($className) {
		echo $className . "<br>";
    $file = __DIR__ . '/' . 'src' . '/'. $className . '.php';
    $file = str_replace('\\', '/', $file);
		$file = str_replace('router', 'src', $file);
		echo $className . "<br>";

    //if (file_exists($file)) { require_once($file); }
		require $file;
});
