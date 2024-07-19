<?php
class DB_Connect {
    private $conn;
 
    // Connecting to database
    public function connect() {
        require_once 'config.php';

         
        // Connecting to mysql database
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
     //   $this->conn-> set_charset("utf8");
        $this->conn->set_charset("utf8");
         
        // return database handler


        return $this->conn;
    }
}
 
?>