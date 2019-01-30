<?php

class Connection {
  // constants
  const SERVER_NAME = 'localhost';
  const USERNAME = 'root';
  const PASSWORD = '';
  const DATABASE_NAME = 'inchoo';

  // properties
  private $pdoConnection;

  // singleton
  public static function getInstance() {
    static $instance = null;
    if($instance === null) { $instance = new self(); }
    return $instance;
  }

  private function __construct() {
    $this->pdoConnection = new PDO("mysql:host=" . self::SERVER_NAME . ";dbname=" . self::DATABASE_NAME, self::USERNAME, self::PASSWORD);
    $this->pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function getPdoConnection() { return $this->pdoConnection; }
}
