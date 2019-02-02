<?php

// namespace
namespace Repository;

// use
use \Model\UserModel;

// class
class UserRepository extends BaseRepository {
	public function selectOneByName($user_name) { return $this->pdoConnection->query("SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1")->fetch(); }
	public function selectOneByEmail($user_email) { return $this->pdoConnection->query("SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1")->fetch(); }
	public function selectOneByEmailAndPassword($user_email, $user_password) {
		return $this->pdoConnection->query("SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$user_password' LIMIT 1");
	}

	public function saveUser(\Model\UserModel $user) {
		$statement = $this->pdoConnection->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email, :user_password)");

		$user_name = $user->getUserName();
		$user_email = $user->getUserEmail();
		$user_password = $user->getUserPassword();

		$statement->bindParam(':user_name', $user_name);
		$statement->bindParam(':user_email', $user_email);
		$statement->bindParam(':user_password', $user_password);

		$statement->execute();
	}
}
