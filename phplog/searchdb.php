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
                    <label>Company: </label>
                    <input type="text" name="company" />
                    <label> EAN: </label>  
                    <input type="text" name="ean" />
                    <label>SKU: </label>
                    <input type="text" name="sku" />
                    <label>Title: </label>
                    <input type="text" name="title" />
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
    $company = $_POST['company'];
    $ean = $_POST['ean'];
    $sku = $_POST['sku'];
    $title = $_POST['title'];
}

include_once("../Classes/ConnectDB.php");
$connection = new ConnectDB();
$conn = $connection->connectDB();

if (!$conn){
    die("<br>Connection failed");
}
if(!empty($company)){
    $cquery = "select count(*) from e_deals_tbl where company='{$company}'";
    $query = "select * from e_deals_tbl where company='{$company}'";
}
if(!empty($ean)){
    $cquery = "select count(*) from e_deals_tbl where company='{$ean}'";
    $query = "select * from e_deals_tbl where ean='{$ean}'";
}
if(!empty($sku)){
    $cquery = "select count(*) from e_deals_tbl where company='{$sku}'";
    $query = "select * from e_deals_tbl where sku='{$sku}'";
}
if(!empty($title)){
    $cquery = "select count(*) from e_deals_tbl where company='%{$title}%'";
    $query = "select * from e_deals_tbl where title like '%{$title}%'";
}

// $result = $conn->query($cquery);
// var_dump($cquery);
// var_dump($result);
// print("<p>Query count: {$result}</p>");

$result = $conn->query($query);
print("<table style='width: 100%'>");
while($field_info = $result->fetch_field()){
    print("<th class='sfnt autowidth'>{$field_info->name}</th>");
    }
while($row = $result->fetch_assoc()){
    print("<tr>");
    foreach($row as $item){
            print("<td class='ssfnt autowidth'>{$item}</td>");
    }
    print("</tr>");
}

print("</table");

$connection->closeDB();
?>