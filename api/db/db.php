<?php
class DB
{
  private $servername = "";
  private $username = "";
  private $password = "";
  private $dbname = "";

  private static $conn = null;

  // Constructor initializes the database connection
  private function __construct()
  {
    if ($_SERVER["SERVER_NAME"] == "0.0.0.0" || $_SERVER["SERVER_NAME"] == "127.0.0.1") {
      $this->servername = "localhost";
      $this->dbname = "inproaires";
      $this->password = "";
      $this->username = "root";
    } elseif ($_SERVER["SERVER_NAME"] == "inproaires.com.co" || $_SERVER["SERVER_NAME"] == "www.inproaires.com.co") {
      $this->servername = "localhost";
      $this->dbname = "pinproap1_inproaires";
      $this->password = "@Yer1006son#";
      $this->username = "pinproap1_admin";
    }
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