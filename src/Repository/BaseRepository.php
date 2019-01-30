<?php

// namespace
namespace Repository;

// abstract class BaseController
abstract class BaseRepository {
  // properties
  protected $pdoConnection;

  // open Connection
  public function __construct() { $this->pdoConnection = \Connection::getInstance()->getPdoConnection(); }
}
