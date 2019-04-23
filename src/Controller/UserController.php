<?php

// namespace
namespace Controller;

// class
class UserController extends BaseController {
	// instantiate UserModel
	public $userModel;
	public function __construct() {
		$this->userModel = new \Model\UserModel();
	}

	// registration method
	public function register() {
		$this->userModel->register();
	}


	// login method
	public function login() {
		$this->userModel->login();
	}
}
