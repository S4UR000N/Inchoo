<?php

// namespace
namespace Controller;

// class
class UserController extends BaseController {
	public $viewData = array(
		"error" => array(),
		"postData" => array()
	);

	// registration method
	public function register() {
		if($_SERVER['REQUEST_METHOD'] === 'GET') { //$this->render_view("User:register", 1);
			$user = new Model\UserModel();
		}
		else {
			$this->viewData['postData']['user_name'] = $_POST['user_name'];
			$this->viewData['postData']['user_email'] = $_POST['user_email'];
			$this->render_view("User:register", 1, $this->viewData);
		}
	}

	public function save($postData = null) {
		//$user = new UserModel();
		//$user->setName($postData['name']);
		//$user->setEmail($postData['email']);
		//$user->setPassword($postData['password']);

		//$userRepository = new UserRepository();
		//$userRepository->saveUser($user);
		}
}
