<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$ean = $_POST['ean'];
$sku = $_POST['sku'];
$name = $_POST['name'];
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

if(!empty($ean)){
    $query = "select * from e_deals_tbl where ean={$ean}";
}

if(!empty($sku)){
    $query = "select * from e_deals_tbl where sku='{$sku}'";
}

if(!empty($name)){
    $query = "select * from e_deals_tbl where title like '%{$name}%'";
}

$result = $conn->query($query);
foreach($result as $row){
    print($row['company'] . " | " .
          "<b>{$row['ean']}</b>" . " | " .
          $row['sku'] . " | " .
          $row['manufacturer'] . " | " .
          "<b>{$row['stock']}</b>" . " | " .
          $row['title'] . " | " .
          "<b>{$row['price']}</b>" . " | " .
          $row['weight'] . " | " .
          $row['time_stamps'] . "<br>");
}

?>