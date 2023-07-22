<html>
    <head>
        <title>Ledynas search</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "style.css">   
    </head>
    <header>
        <div style="text-align: center;">
            <img width="400" src="Ledynas_logo.png">
        </div>
    </header>
    <body>
        <div class="d-flex align-items-center justify-content-center" style="height: 250px;">
            <div class="p-4 m-2 text-black">
            <div class="row">
                <h6>Database created</h6>
                <div style='font-size: 14px'>&emsp;<?php require "dbShowDate.php"; ?></div>
            </div>
            <br>
            <div class="row">
                <h2>Search</h2>
            </div>
            <div class="row">
                <form action="" method="post">
                    <label> EAN: </label>  
                    <input type="text" name="ean">
                    <label>SKU: </label>
                    <input type="text" name="sku">
                    <label>Name: </label>
                    <input type="text" name="name">
            </div>
                <div class="row">
                    <input type= "submit" class="btn center" value="Search" />
                </div>
                <br><br>
                </form>
            </div>
        </div>
    </body>
    <footer>
        &copy; <em id="date"></em> 2023
    </footer>
</html>

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
print("<p style='font-size: 14'><b>Company | EAN | SKU | Manufacturer | Stock | Title | Price | Weight |</b></p>");
foreach($result as $row){
    print("<a style='font-size: 12px'> {$row['company']} | <b>{$row['ean']}</b> | {$row['sku']} | 
          {$row['manufacturer']} | <b>{$row['stock']}</b> | {$row['title']} | <b>{$row['price']}</b> | 
          {$row['weight']} | {$row['time_stamps']}<br> </a>");
}

?>