<?php include_once = "search.php" ?>

<html>
    <head>
        <title>Ledynas login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "style.css">   
    </head>
    <header>
            <img src="Ledynas_logo.png" width="300" height="100">
    </header>
    <body>
        <div class="d-flex align-items-center justify-content-center">
            <form action="" method="post">
                <h2>Login</h2>
                    <p>  
                        <label> UserName: </label><br>  
                        <input type="text" id ="user" name="user" />  
                    </p>  
                    <p>  
                        <label> Password: </label><br>
                        <input type="password" id="pass" name = "pass" />  
                    </p>  
                    <p>     
                        <input type= "submit" class="btn" value="Login" />
                    </p>  
            </form>
        </div>
    </body>
    <footer>
        &copy; <em id="date"></em> 2023
    </footer>
</html>

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