<?php

// namespace
namespace Controller;

// class
class HomeController extends BaseController {
  public $viewData = array();
  public function home() {
    var_dump($_COOKIE['login']);

    // if not loged in
    if(!isset($_COOKIE['login'])) { $this->render_view("Out:home", 1, $this->viewData); }
    else { echo "RIP"; }
  }
}
