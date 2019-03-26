<?php

// namespace
namespace Controller;

// class
class ManagementController extends BaseController {
	public $viewData = array();
	public function management() {
		// Upload File Branch
		if(!empty($_FILES)) {
			$fail = false;
			$invalid;
			$fileRepo = new \Repository\FileRepository();
			$invalid = $fileRepo->validateFile($this->viewData);

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
					$this->viewData['uploaded'] = $fileRepo->saveFile($file);

					$this->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
					$this->render_view("In:management", 1, $this->viewData);
				}
				else {
					// Return View With Fail Message
 				 array_push($this->viewData, "File Upload Failed!");
				 $this->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
				 $this->render_view("In:management", 1, $this->viewData);
				}
			}
			// else Send Error Data to View
			else {
				$this->viewData['invalid'] = $invalid;
				$this->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
				$this->render_view("In:management", 1, $this->viewData);
			}
		}
		// Delete File Branch
		else if(array_key_exists('file_id', $_POST)) {
			$this->viewData['deleted'] = false;
			$fileRepo = new \Repository\FileRepository();
			$isDeleted = $fileRepo->deleteFile($_POST['user_id'], $_POST['file_id']);
			if($isDeleted) { $unlink = unlink("uploads/" . $_SESSION['user_id'] . $_POST['file_name']); }
			if($isDeleted > 0 && $unlink) { $this->viewData['deleted'] = true; }

			$this->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
			$this->render_view("In:management", 1, $this->viewData);
		}
		// Regular Render Branch
		else {
			$fileRepo = new \Repository\FileRepository();
			$this->viewData['viewFiles'] = $fileRepo->selectUserFilesUnionOtherFiles();
			$this->render_view("In:management", 1, $this->viewData);
		}
	}
}
