<?php

// namespace
namespace Controller;

// class
class UserController extends BaseController {
	// registration method
	public function register() {
		if($_SERVER['REQUEST_METHOD'] === 'GET') { $this->render_view("User:register", 1); }
		else {
			// Final View Data
			$viewData = array(
				'Valid' => array(),
				'Error' => array()
			);

			// Partialy Valid Data Requires Compact
			$Valid = array(
				"user_name" => "",
				"user_email" => ""
			);

			// Error Possibilities
			$Error = array(
				"1" => "All Fields Required!",
				"2" => "Invalid Email!",
				"3" => "Name is in Use!",
				"4" => "Email is in Use!",
				"5" => "Invalid Passwords!"
			);

			// Error Controller
			$err_data = array();

			// Error Checking
			foreach($_POST as $err) { if(!in_array("1", $err_data) && empty($err)) { array_push($err_data, "1"); } }

			if(!empty($_POST['user_email']) && strpos($_POST['user_email'], '@') === false) { array_push($err_data, "2"); }
			else {
				// open DB connection
				$userRepo = new \Repository\UserRepository();

				// check if name & email aleready exist
				$name_check = $userRepo->selectOneByName($_POST['user_name']);
				$email_check = $userRepo->selectOneByEmail($_POST['user_email']);

				if($name_check) { array_push($err_data, "3"); }
				else { $Valid['user_name'] = $_POST['user_name']; }

				if($email_check) { array_push($err_data, "4"); }
				else { $Valid['user_email'] = $_POST['user_email']; }
			}

			if(!empty($_POST['user_password']) && $_POST['user_password'] !== $_POST['user_confirm_password']) { array_push($err_data, "5"); }

			// Store Errors to View Data
			foreach($err_data as $err) { array_push($viewData['Error'], $Error[$err]); }

			// Store All Valids to View Data
			foreach($Valid as $key => $val) { if(!empty($val)) { $viewData['Valid'][$key] = $val; } }

			// if Form not fully correct pass Valid and Error Data
			if(!empty($err_data)) { $this->render_view("User:register", 1, $viewData);
			}
			// else Save User & redirect
			else {
				// open DB connection
				$userRepo = new \Repository\UserRepository();

				// Save User
				$user = new \Model\UserModel();
				$user->setUserName($_POST['user_name']);
				$user->setUserEmail($_POST['user_email']);
				$user->setUserPassword(md5($_POST['user_password']));
				$userRepo->saveUser($user);
				header("location: http://inchoo.local/login");
			}
		}
	}


	// login method
	public function login() {
		if($_SERVER['REQUEST_METHOD'] === 'GET') { $this->render_view("User:login", 1); }
		else {
			// Final View Data
			$viewData = array(
				'Valid' => array(),
				'Error' => array()
			);

			// Error Possibilities
			$Error = array(
				"1" => "All Fields Required!",
				"2" => "Invalid Email!",
				"3" => "Wrong Email or Password!"
			);

			// Error Controller
			$err_data = array();

			// Error Checking
			foreach($_POST as $err) { if(!in_array("1", $err_data) && empty($err)) { array_push($err_data, "1"); } }

			if(!empty($_POST['user_email']) && strpos($_POST['user_email'], '@') === false) { array_push($err_data, "2"); }
			else { if(!empty($_POST['user_email'])) { $viewData['Valid']['user_email'] = $_POST['user_email']; } }

			if(!empty($viewData['Valid']) && !empty($_POST['user_password'])) {
				// open DB connection
				$userRepo = new \Repository\UserRepository();

				// check if user exists
				$user_email = $_POST['user_email'];
				$user_password = md5($_POST['user_password']);
				$user_check = $userRepo->selectOneByEmailAndPassword($user_email, $user_password)->fetch();

				if(!$user_check) { array_push($err_data, "3"); }
			}

			// Store Errors to View Data
			foreach($err_data as $err) { array_push($viewData['Error'], $Error[$err]); }

			// if Form not fully correct pass Valid and Error Data
			if(!empty($err_data)) { $this->render_view("User:login", 1, $viewData); }
			// else Set Session and Redirect
			else {
				// open DB connection
				$userRepo = new \Repository\UserRepository();

				// get user id
				$user_email = $_POST['user_email'];
				$user_password = md5($_POST['user_password']);
				$user_check = $userRepo->selectOneByEmailAndPassword($user_email, $user_password)->fetch(\PDO::FETCH_ASSOC);

				// Set Session
				$_SESSION['user_id'] = $user_check['user_id'];
				$_SESSION['user_name'] = $user_check['user_name'];

				// Redirect
				header("location: http://inchoo.local/management");
			}
		}
	}
}
