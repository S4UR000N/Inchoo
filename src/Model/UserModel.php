<?php

// namespace
namespace Model;

// class User
class UserModel {
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
}
