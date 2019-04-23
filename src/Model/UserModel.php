<?php

// namespace
namespace Model;

// class User
class UserModel extends BaseModel {
    // properties
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_password;

    // id -> getId
    public function getUserId() { return $this->user_id; }

    // name -> setName, getName
    public function setUserName($name) { $this->user_name = $name; }
    public function getUserName() { return $this->user_name; }

    // email -> setEmail, getEmail
    public function setUserEmail($email) { $this->user_email = $email; }
    public function getUserEmail() { return $this->user_email; }

    // password -> setPassword, getPassword
    public function setUserPassword($password) { $this->user_password = $password; }
    public function getUserPassword() { return $this->user_password; }


    /* OTHER */
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
  			if(!empty($err_data)) { $this->render_view("User:register", 1, $viewData); }

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
    // myaccount method
    public function myaccount($me) {
  		if(array_key_exists('user_id', $_SESSION)) {
  			if($_POST) {
  				if(array_key_exists('remove_account', $_POST)) {
  					$userRepo = new \Repository\UserRepository();
  					$result = $userRepo->removeAccount($_SESSION['user_id']);
  					if($result) { session_destroy(); header("location: http://inchoo.local/"); }
  					else {
  						$me->viewData['AccountRemovalFailed'] = true;
  						$this->render_view("In:myaccount", 1, $me->viewData);
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
  					foreach($err_data as $err) { array_push($me->viewData['Error'], $Error[$err]); }

  					// if Form not fully correct pass Error Data
  					if(!empty($err_data)) { $this->render_view("In:myaccount", 1, $me->viewData); }
  					else {
  						$userRepo = new \Repository\UserRepository();
  						$result = $userRepo->changePassword($_SESSION['user_id'], $_POST['user_change_password']);
  						if($result) { $me->viewData['Valid'] = true; }
  						else { $me->viewData['Valid'] = false; }
  						$this->render_view("In:myaccount", 1, $me->viewData);
  					}
  				}
  			}
  			$this->render_view("In:myaccount", 1, $me->viewData);
  		}
      else { header("location: http://inchoo.local/"); }
  	}
    // management
    public function management($me) {
  		// Upload File Branch
  		if(!empty($_FILES)) {
  			$fail = false;
  			$invalid;
  			$fileRepo = new \Repository\FileRepository();
  			$invalid = $fileRepo->validateFile($me->viewData);

  			// if true then Upload and Save file or Return fail
  			if(!$invalid) {
  				// Target dir/file/extension
  				$target_dir = "uploads/" . $_SESSION['user_id'];
  				$target_file = $target_dir . $_FILES['img_up']['name'];

  				// Store File
  				if(move_uploaded_file($_FILES['img_up']['tmp_name'], $target_file)) {
  					$file = new \Model\FileModel();
  					$file->setUserId($_SESSION['user_id']);
  					$file->setFileName($_FILES['img_up']['name']);
  					$me->viewData['uploaded'] = $fileRepo->saveFile($file);

  					$me->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
  					$this->render_view("In:management", 1, $me->viewData);
  				}
  				else {
  					// Return View With Fail Message
   				 array_push($me->viewData, "File Upload Failed!");
  				 $me->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
  				 $this->render_view("In:management", 1, $me->viewData);
  				}
  			}
  			// else Send Error Data to View
  			else {
  				$me->viewData['invalid'] = $invalid;
  				$me->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
  				$this->render_view("In:management", 1, $me->viewData);
  			}
  		}
  		// Delete File Branch
  		else if(array_key_exists('file_id', $_POST)) {
  			$me->viewData['deleted'] = false;
  			$fileRepo = new \Repository\FileRepository();
  			$isDeleted = $fileRepo->deleteFile($_POST['user_id'], $_POST['file_id']);
  			if($isDeleted) { $unlink = unlink("uploads/" . $_SESSION['user_id'] . $_POST['file_name']); }
  			if($isDeleted > 0 && $unlink) { $this->viewData['deleted'] = true; }

  			$me->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
  			$this->render_view("In:management", 1, $me->viewData);
  		}
  		// Regular Render Branch
  		else {
  			$fileRepo = new \Repository\FileRepository();
  			$me->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
  			$this->render_view("In:management", 1, $me->viewData);
  		}
  	}
}
