<?php

// namespace
namespace Controller;

// abstract class BaseController
abstract class BaseController {


  // go back for $int directory levels from current directory
  public function dir_back($int) {
    $path = "";

    // get directories
    $dirs = explode("\\", __DIR__);

    // remove (i) directories
    for($i = 0; $i < $int; $i++) { array_pop($dirs); }

    // build path
    for($i = 0; $i < count($dirs); $i++) {
      if($path === "") { $path .= $dirs[$i]; }
      else { $path .= "/" . $dirs[$i]; }
    }

    // return path
    return $path;
  }

  // render View, Parameter: 1 => Folder:File, 2 => num of dir lvls to reach "src", 3 => Pass any Data to View
  public function render_view($view, $int = 0, $viewData = array()) {
    // get base path
    if($int) { $path = $this->dir_back($int); }

    // set full path
    $path .= "/View";
    $render = explode(":", $view);
    foreach($render as $bind) { $path .=  "/" . $bind; }

    $path .= ".php";

    // render view
    return require_once $path;
  }
}
