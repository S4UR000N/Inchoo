<?php

// namespace
namespace Model;

// class File
class FileModel {
    // properties
    private $user_id;
    private $file_id;
    private $file;

    // user_id -> setUserId, getUserId
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function getUserId() { return $this->user_id; }

    // file -> setFile, getFile
    public function setFileId($file_id) { $this->file_id = $file_id; }
    public function getFileId() { return $this->file_id; }

    // file -> setFile, getFile
    public function setFile($file) { $this->file = $file; }
    public function getFile() { return $this->file; }

}
