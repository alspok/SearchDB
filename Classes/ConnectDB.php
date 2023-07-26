<?php

class ConncctDB {
    private $server = "db-mysql-fra1-42194-do-user-14106707-0.b.db.ondigitalocean.com";
    private $username = "doadmin";
    private $password = "AVNS_IzETuacH57EOU-TThcJ";
    private $database = "e_deals_db";
    private $port = 25060;
    private $sslmode = "REQUIRE";
    private $conn;

 public function connectDB() {
  $this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->database, $this->port, $this->sslmode);
  if(!$this->conn){
    die("<p>Connection failed:</p> " . mysqli_connect_error());
  }
  else{
    print("<p>Connection established</p>");
  }
  return $this->conn;
 }

 public function closeDB(){
    $this->conn->close();
    print("<br><p>Connection closed</p>");
 }
}

?>