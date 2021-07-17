<?php
class Database {
	// database credentials
  private $host = "localhost";
  private $db_name = "lms_restapi";
  private $username = "root";
  private $password = "";
  public $conn;
  
	// database connection
  public function getConnection() {
    
    // Create connection
		$this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
		
		// Check connection
		if (!$this->conn) {
			$this->conn = "Connection failed: " . mysqli_connect_error();
		}
		    
    return $this->conn;
	}
}
?>
