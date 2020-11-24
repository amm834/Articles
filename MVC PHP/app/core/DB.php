<?php
class DB {
  private $dbh;
  private $stmt;
  private $hostName = 'localhost';
  private $userName = 'root';
  private $userPass = '';
  private $dbName = 'ecommerence';
  function __construct() {
    try {
      $this->dbh = new PDO("mysql:host=".$this->hostName.";dbname=".$this->dbName, $this->userName, $this->userPass);
      // Catch Db Error
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  // Insert Query and Prepare with statement
  function query($qry) {
    $this->stmt = $this->dbh->prepare($qry);
  }
  function execute() {
    return $this->stmt->execute();
  }
  function multiSet() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }
}



?>