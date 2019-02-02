<?php

// namespace
namespace Controller;

// class
class TestController extends BaseController {
  public $viewData = array();
  public function test() {
    echo $_COOKIE['login'];
  }
}
