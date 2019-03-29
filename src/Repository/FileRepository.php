<?php

// namespace
namespace Repository;

// class
class FileRepository extends BaseRepository {
	public function validateFile(array $viewData = array()) {
		// Error Boolean
		$err_bool = 0;

		// Target dir/file/extension
		$target_dir = "uploads/" . $_SESSION['user_id'];
		$target_file = $target_dir . basename($_FILES['img_up']['name']);
		$target_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if File is real/fake image
		$check = getimagesize($_FILES['img_up']['tmp_name']);
		if($check === false) { array_push($viewData, "File is not an image!"); $err_bool = 1; }

		// Check if File already Exists
		if($err_bool == 0) { if(file_exists($target_file) ) { array_push($viewData, "File already exists!"); $err_bool = 1; } }

		// Check File Size
		if($err_bool == 0) { if($_FILES['img_up']['size'] > 800000) { array_push($viewData, "File is too large!"); $err_bool = 1; } }

		// Allow only jpeg/jpg/png
		if($err_bool == 0) {
			if($target_extension != "jpeg" && $target_extension != "jpg" && $target_extension != "png") {
				array_push($viewData, "Invalid file type!"); $err_bool = 1;
			}
		}

		// return View data
		if($err_bool == 0) { return $viewData = false; }
		return $viewData;
	}
	public function selectAllFiles() {
		$DB = $this->pdoConnection->query("SELECT users.user_id, users.user_name, users.user_email, files.file_id, files.file_name FROM users JOIN files ON users.user_id = files.user_id")->fetchAll(\PDO::FETCH_ASSOC);
		return $DB;
	}
	public function selectUserFilesUnionOtherFiles($viewData = null) {
		// Get All Image Files of the User and Other Users
		$DB = $this->pdoConnection->query("SELECT * FROM files WHERE user_id = {$_SESSION['user_id']} UNION SELECT * FROM files WHERE user_id != {$_SESSION['user_id']}")->fetchAll(\PDO::FETCH_ASSOC);
		return $DB;
	}
	public function saveFile(\Model\FileModel $file) {
		$statement = $this->pdoConnection->prepare("INSERT INTO files (user_id, file_name) VALUES (:user_id, :file_name)");

		$user_id = $file->getUserId();
		$file_name = $file->getFileName();

		$statement->bindParam(':user_id', $user_id);
		$statement->bindParam(':file_name', $file_name);

		$result = $statement->execute();
		return $result;
	}
	public function deleteFile($user_id, $file_id) {
		$DB = $this->pdoConnection->query("DELETE FROM files WHERE user_id = $user_id AND file_id = $file_id");
		return $DB->rowCount();
	}
}
