<html>
    <head>
        <title>Ledynas export</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "style.css">   
    </head>
    <header>
            <img src="Ledynas_logo.png" width="300" height="100">
    </header>
    <body>
        <div class="d-flex align-items-center justify-content-center">
            <form action="" method="post">
                <h2>Export file</h2>
                    <p>  
                        <label> Export for </label><br>
                        <select name="supplier"> 
                        <option value="no_selection"></option> 
                            <option value="varle">Varle</option> 
                            <option value="pigu">Pigu</option> 
                            <option value="kazkas">Kazkas</option> 
                        </select>
                        <!-- <input type="text" id ="user" name="export_for" />   -->
                    </p>  
                    <p>  
                        <label> File name </label><br>  
                        <input type="text" id ="user" name="file_name" />  
                    </p>  
                    <p>  
                        <label> Margin % </label><br>
                        <input type="text" id="pass" name = "margin" />  
                    </p>
                    <p>  
                        <label> Min stock </label><br>
                        <input type="text" id="pass" name = "min_stock" />  
                    </p>
                    <p>
                        <label> Min price </label><br>
                        <input type="text" id="pass" name = "min_price" />  
                    </p>  
                    <p>
                        <label> No suppliers </label><br>
                        <input type="textd" id="pass" name = "suppliers" />  
                    </p>  
                    <p>     
                        <input type= "submit" class="btn" value="Export" />
                    </p>  
            </form>
        </div>
    </body>
    <footer>
        &copy; <em id="date"></em> 2023
    </footer>
</html>


<?php
include_once("../Classes/ConnectDB.php");
// include("/var/www/html/SearchDB/Classes/ConnectDB.php");
$connection = new ConncctDB();
$conn = $connection->connectDB();

$query = "select * from e_deals_tbl limit 1000, 1";
$result = $conn->query($query);
foreach($result as $row){
    print_r($row );
    // print($row['id'] . $row['company'] . $row['ean'] . $row['title'] . $row['price'] . $row['time_stamp'] . "<br>");
}

$connection->closeDB();

$files = scandir("../ExportFiles");
print_r($files);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $export_for = $_POST['export_for'];
    if(empty($export_for)){
      print("Export for is empty<br>");
    }
    $file_name = $_POST['file_name'];
    if(empty($file_name)){
        print("File name field is empty<br>");
    }
    $margin = $_POST['margin'];
    if(empty($margin)){
        print("Margin field is empty<br>");
    }
    $min_stock = $_POST['margin'];
    if(empty($min_stock)){
        print("Min stock field is empty<br>");
    }
    $min_price = $_POST['min_price'];
    if(empty($min_price)){
        print("Min price field is empty<br>");
    }
    $suppliers = $_POST['suppliers'];
    if(empty($suppliers)){
        print("Suppliers field is empty<br>");
    }
}


?>