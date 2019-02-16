<?php

// namespace
namespace Controller;

// class
class LogoutController extends BaseController {
	public function logout() {
		// Unset Cookie
		setcookie("login", FALSE, -1, '/', 'inchoo.local');

		// Destory Session
		//session_destroy();

		// Redirect
		if(isset($_COOKIE['login'])) { echo '<div id="cookie">' . $_COOKIE['login'] . '</div>'; }
		else { echo "no cookie"; }
		//header("location: http://inchoo.local/");
	}
}
