<?php

// namespace
//namespace Controller;

// class
class UserController extends BaseController {
	public function register() { $this->save(); $this->render_view("User:register", 1); }

	public function save($postData = null) {
		$user = new UserModel();
		//$user->setName($postData['name']);
		//$user->setEmail($postData['email']);
		//$user->setPassword($postData['password']);

		$userRepository = new UserRepository();
		//$userRepository->saveUser($user);
		}
}
