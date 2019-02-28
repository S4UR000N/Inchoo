<?php

// namespace
namespace Controller;

// class
class LogoutController extends BaseController {
	public function logout() {
		// Destroy Session
		//if(session_status() == PHP_SESSION_NONE) { session_start(); }
		session_destroy();

		// Redirect
		header("location: http://inchoo.local/");
	}
}
