<?php

// namespace
namespace Controller;

// class
class ManagementController extends BaseController {
	// instantiate UserModel
	public $userModel;
	public function __construct() {
		$this->userModel = new \Model\UserModel();
	}

	// View Data
	public $viewData = array();

	public function management() {
		$this->userModel->management($this);
	}
}
