<?php

// namespace
namespace Controller;

// class
class MyAccountController extends BaseController {
	public $viewData = array();
	public function get() {
		if(array_key_exists('user_id', $_SESSION)) { $this->render_view("In:myaccount", 1, $this->viewData); }
    else { header("location: http://inchoo.local/"); }
	}
}
