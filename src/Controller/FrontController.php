<?php

// namespace
namespace Controller;

// class
class FrontController extends BaseController {
  public $viewData = array(1, 2, 3, 4, 5);
  public function home() { $this->render_view("Page:home", 1, $this->viewData); }

  public function faq() {}
}
