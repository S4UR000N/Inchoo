<?php

// namespace
namespace Controller;

// class
class MyAccountController extends BaseController {
	public $viewData = array(
		'Error' => array(),
	);
	public function myaccount() {
		if(array_key_exists('user_id', $_SESSION)) {
			if($_POST) {
				if(array_key_exists('remove_account', $_POST)) {
					$userRepo = new \Repository\UserRepository();
					$result = $userRepo->removeAccount($_SESSION['user_id']);
					if($result) { session_destroy(); header("location: http://inchoo.local/"); }
					else {
						$this->viewData['AccountRemovalFailed'] = true;
						$this->render_view("In:myaccount", 1, $this->viewData);
					}
				}
				else {
					// Error Possibilities
					$Error = array(
						"1" => "All Fields Required!",
						"2" => "Invalid Passwords!"
					);

					// Error Controller
					$err_data = array();

					// Error Checking
					foreach($_POST as $err) { if(!in_array("1", $err_data) && empty($err)) { array_push($err_data, "1"); } }
					if(!empty($_POST['user_change_password']) && $_POST['user_change_password'] !== $_POST['user_confirm_changed_password']) { array_push($err_data, "2"); }

					// Store Errors to View Data
					foreach($err_data as $err) { array_push($this->viewData['Error'], $Error[$err]); }

					// if Form not fully correct pass Error Data
					if(!empty($err_data)) { $this->render_view("In:myaccount", 1, $this->viewData); }
					else {
						$userRepo = new \Repository\UserRepository();
						$result = $userRepo->changePassword($_SESSION['user_id'], $_POST['user_change_password']);
						if($result) { $this->viewData['Valid'] = true; }
						else { $this->viewData['Valid'] = false; }
						$this->render_view("In:myaccount", 1, $this->viewData);
					}
				}
			}
			$this->render_view("In:myaccount", 1, $this->viewData);
		}
    else { header("location: http://inchoo.local/"); }
	}
}
