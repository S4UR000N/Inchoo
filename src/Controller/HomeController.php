<?php

// namespace
namespace Controller;

// class
class HomeController extends BaseController {
  public $viewData = array(1, 2, 3, 4, 5);
  public function home() { $this->render_view("Out:home", 1, $this->viewData); }
}
