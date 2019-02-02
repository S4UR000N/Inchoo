<?php

// namespace
namespace Controller;

// class
class HomeController extends BaseController {
  public $viewData = array();
  public function home() {
    if(!isset($_COOKIE['login'])) { $this->render_view("Out:home", 1, $this->viewData); }
    else { $this->render_view("In:home", 1, $this->viewData); }
  }
}
