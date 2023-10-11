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
                <div class='sfnt'><b>Database created</b></div>
                <div class='sfnt'>&emsp;<?php require "dbShowDate.php"; ?></div>
            </div>
            <br>
            <div class="row">
                <h6>Search</h6>
            </div>
            <div class="row sfnt">
                <form action="" method="post">
                    <label> EAN: </label>  
                    <input type="text" name="ean">
                    <label>SKU: </label>
                    <input type="text" name="sku">
                    <label>Name: </label>
                    <input type="text" name="name">
            </div>
                <div class="row">
                    <button class="button" value="search">Search</button>
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

include_once("../Classes/ConnectDB.php");
$connection = new ConncctDB();
$conn = $connection->connectDB();

// $server = "db-mysql-fra1-42194-do-user-14106707-0.b.db.ondigitalocean.com";
// $username = "doadmin";
// $password = "AVNS_IzETuacH57EOU-TThcJ";
// $database = "e_deals_db";
// $port = 25060;
// $sslmode = "REQUIRE";

if (!$conn){
    die("<br>Connection failed");
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
print("<table>");
while($head = $result->fetch_field()){
    print("<tr>");


}
print("/table");

print("<p style='font-size: 14'>Company | <b>EAN</b> | SKU | Manufacturer | <b>Stock</b> | Title | <b>Price</b> | Weight |</p>");
foreach($result as $row){
    print("<a style='font-size: 12px'> {$row['company']} | <b>{$row['ean']}</b> | {$row['sku']} | 
          {$row['manufacturer']} | <b>{$row['stock']}</b> | {$row['title']} | <b>{$row['price']}</b> | 
          {$row['weight']} | {$row['time_stamps']}<br> </a>");
}

?>