<?php

// namespace
//namespace Controller;

// class
class FrontController extends BaseController {
  public function home() { $this->render_view("Page:home", 1); }

  public function faq() {}
}
