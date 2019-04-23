<?php

// namespace
namespace Controller;

// class
class MyAccountController extends BaseController {
	// instantiate UserModel
	public $userModel;
	public function __construct() {
		$this->userModel = new \Model\UserModel();
	}

	// View Data
	public $viewData = array(
		'Error' => array(),
	);

	public function myaccount() {
		$this->userModel->myaccount($this);
	}
}
