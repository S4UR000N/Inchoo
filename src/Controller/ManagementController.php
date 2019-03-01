<?php

// namespace
namespace Controller;

// class
class ManagementController extends BaseController {
	public $viewData = array();
	public function management() {
    $this->render_view("In:management", 1, $this->viewData);
  }
}
