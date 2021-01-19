<?php

    class Database {
      // DB Params
      private $host;
      private $dbname;
      private $username;
      private $password;
      private $connection;

      public function __construct($configObject) {
        $this->connection = null;
        $this->host = $configObject->host;
        $this->dbname = $configObject->dbname;
        $this->username = $configObject->username;
        $this->password = $configObject->password;
      }
  
      // DB Connect
      public function connect() {
        try { 
          $this->connection = new PDO("mysql:{$this->host}=;dbname={$this->dbname}", $this->username, $this->password);
          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->connection;
      }
    }
?>