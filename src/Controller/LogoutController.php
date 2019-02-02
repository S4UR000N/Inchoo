<?php

// namespace
namespace Controller;

// class
class LogoutController extends BaseController {
	public function logout() {
		// Unset Cookie
		setcookie("login", "", time() - 86400, "/");

		// Destory Session
		session_destroy();

		// Redirect
		if(isset($_COOKIE['login']) && isset($_SESSION['user_name'])) { echo '<div id="cs">' . $_COOKIE['login'] . "::" . $_SESSION['user_name'] . '</div>'; }
		else { echo "meh"; }
		header("location: http://inchoo.local/");
	}
}
