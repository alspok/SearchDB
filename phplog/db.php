<?php
function db_connect(){
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
     else{
        echo "<br>Connection established.";
     }

    return $conn;
}
?>