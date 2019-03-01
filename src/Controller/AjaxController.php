<?php

// namespace
namespace Controller;

// class
class AjaxController extends BaseController {
	public function AjaxGetAllFiles() {
		if(!array_key_exists('user_id', $_SESSION)) {
			echo "simple query";
		}
		else {
			echo "complex query";
		}
	 }
}
