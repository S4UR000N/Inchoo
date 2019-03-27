<?php

// namespace
namespace Controller;

// class
class AjaxController extends BaseController {
	public function AjaxGetAllFiles() {
		// open DB connection
		$userRepo = new \Repository\FileRepository();
		$files = $userRepo->selectAllFiles();

		// Output Holder
		$data = "";

		if($files) {
			foreach($files as $file) {
				$data .=
					"<tr>" .
				 	"<td>" . $file['file_name'] . "</td>" .
					"<td class='preview_init' data-user_id='" . $file['user_id'] . "'" . "data-file_id='" . $file['file_id'] . "'" . "data-file_name='" . $file['file_name'] . "' " . "data-toggle='modal' " . "data-target='#preview' " . "><i class='fas fa-eye text-warning'></i></td>" .
					"<td><a href='http://inchoo.local/uploads/" . $file['user_id'] . $file['file_name'] . "' download>" . "<div><i class='fas fa-download text-primary'></i></div></a></td>" .
				 	"</tr>";
			}
			echo $data;
		}
		else { echo 0; }
	}
}
