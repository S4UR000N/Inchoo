<?php

// namespace
namespace Model;

// class User
class User {
    // properties
    private $id;
    private $name;
    private $email;
    private $password;

    // id -> getId
    public function getId() { return $this->id; }

    // name -> setName, getName
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }

    // email -> setEmail, getEmail
    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }

    // password -> setPassword, getPassword
    public function setPassword($password) { $this->password = $password; }
    public function getPassword() { return $this->password; }
}