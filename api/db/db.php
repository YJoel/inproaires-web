<?php
class DB
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "inproaires";

  private static $conn = null;

  // Constructor initializes the database connection
  private function __construct()
  {
    self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
  }

  public static function getConnection()
  {
    if (self::$conn == null) {
      new DB();
      if (self::$conn->connect_error) {
        die("Connection failed: " . self::$conn->connect_error);
      }
    }

    return self::$conn;
  }
}