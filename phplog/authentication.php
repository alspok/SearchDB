<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['user'];
    if (empty($name)){
      print("Name is empty");
    }
    // else {
    //   print($name . '<br>');
    // };

    $pass = $_POST['pass'];
    if (empty($pass)){
        print("Pass is empty");
    }
    // else{
    //     print(md5($pass));
    // }
  }

$server = "db-mysql-fra1-42194-do-user-14106707-0.b.db.ondigitalocean.com";
$username = "doadmin";
$password = "AVNS_IzETuacH57EOU-TThcJ";
$database = "e_deals_db";
$port = 25060;
$sslmode = "REQUIRE";

$conn = mysqli_connect($server, $username, $password, $database, $port, $sslmode);

if (!$conn){
    die("<br>Connection failed: " . mysqli_connect_error());
  }

$query = "select * from logo_tbl";
$result = $conn->query($query);
$boolen = FALSE;
foreach($result as $row){
  // print($row['username'] . " " . $row['passcode'] . "<br>");
  if(($name == $row['username']) && ($row['passcode'] == md5($pass))){
    $boolen = TRUE;
    break;
  }
}

if($boolen){
  // print($name . " is loged in<br>");
  $conn->close();
  readfile("select.html");
}
else{
  print("Wrong username or password<br>");
  $conn->close();
}

?>