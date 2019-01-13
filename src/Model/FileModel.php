<?php

// namespace
namespace Model;

// class File
class File {
    // properties
    private $id;
    private $file;
    private $user_id;
    private $privilege;

    // id -> getId
    public function getId() { return $this->id; }

    // file -> setFile, getFile
    public function setFile($file) { $this->file = $file; }
    public function getFile() { return $this->file; }

    // user_id -> setUserId, getUserId
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function getUserId() { return $this->user_id; }

    // privilege -> setPrivilege, getPrivilege
    public function setPrivilege($privilege) { $this->privilege = $privilege; }
    public function getPrivilege() { return $this->privilege; }
}