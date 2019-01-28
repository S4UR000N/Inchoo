<?php
spl_autoload_register(function ($classname) {
    var_dump($classname); echo "<br>";
		// auto fullfill path
		if(strpos($classname, 'Controller') !== false && strpos($classname, 'Model') !== false)  {
      echo "Replacing: "; var_dump($classname); echo "<br>";
      $classname = str_replace("Controller\\", "", $classname);
      echo "Replacement: "; var_dump($classname); echo "<br>"WTF"???<br><br>";
    }
		//if(strpos($classname, 'Model') !== false)  { $classname = 'Model\\' . $classname; }

    $file = __DIR__ . '/' . 'src' . '/'. $classname . '.php';
    $file = str_replace('\\', '/', $file);
		$file = str_replace('router', 'src', $file);

    if (file_exists($file)) { require_once($file); }
		//require $file;
		//die("<br>RIP");
});
