<html>
    <head>
        <title>Ledynas export</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
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
                        <select name="export_for" style="width: 190px" size="2" > 
                            <option value="varle">Varle</option> 
                            <option value="pigu">Pigu</option> 
                            <option value="kazkas">Kazkas</option> 
                        </select>
                        <!-- <input type="text" id ="user" name="export_for" />   -->
                    </p>  
                    <p>  
                        <label> File name  <span class="sfnt">( extention *.export.csv )</span> </label><br>  
                        <input type="text" name="file_name" />  
                    </p>  
                    <p>  
                        <label> Margin <span class="sfnt">( % )</span></label><br>
                        <input type="text" name = "margin" />  
                    </p>
                    <p>  
                        <label> Min stock </label><br>
                        <input type="text" name = "min_stock" />  
                    </p>
                    <p>
                        <label> Min price </label><br>
                        <input type="text" name = "min_price" />  
                    </p>  
                    <p>
                        <label> Suppliers <span class="sfnt">( 'ctr' for multiple selection )</span> </label><br>
                        <select name="companies[]" style="width:190px" size="3" multiple>
                            <option value="Gitana"> Gitana </option>
                            <option value="Action"> Action </option>
                            <option value="Appolo"> Appolo </option>
                            <option value="Domitech"> Domitech </option>
                            <option value="Nzd"> Nzd </option>
                            <option value="Verkkakoupa"> Verkkakoupa </option>
                        </select>
                    </p>  
                    <p>     
                        <input type= "submit" class="btn" value="Export" />
                    </p>  
            </form>
        </div>
        <h6>Exported files</h6>
        <?php
            $files = scandir("../ExportFiles");
            foreach($files as $file){
                if($file == '.' or $file == '..' or $file == '.gitkeep'){
                    continue;
                }
                else{
                    $file_name = "../ExportFiles/" . $file;
                    $cdate = date ("Y-m-d H:i:s.", filemtime($file_name));
                    // print("<a class='.fnt'>{$file}.export.csv created at: {$cdate}</a></br>");
                    print("<a style='font-size: 12px'><b>{$file}.export.csv</b> created at: {$cdate}</a></br>");
                }
            }
            print("<br><br>");
        ?>
    </body>
    <footer>
        &copy; <em id="date"></em> 2023
    </footer>
</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $export_for = $_POST['export_for'];
    if($export_for == NULL){
      print("<div class='fnt'>Export for is empty</div>");
    }
    $file_name = $_POST['file_name'];
    if($file_name == NULL){
        print("<div class='fnt'>File name field is empty</div>");
    }
    $margin = $_POST['margin'];
    if($margin == NULL){
        print("<div class='fnt'>Margin field is empty</div>");
    }
    $min_stock = $_POST['min_stock'];
    if($min_stock == NULL){
        print("<div class='fnt'>Min stock field is empty</div>");
    }
    $min_price = $_POST['min_price'];
    if($min_price == NULL){
        print("<div class='fnt'>Min price field is empty</div>");
    }
    $companies = $_POST['companies'];
    if($companies == NULL){
        print("<div class='fnt'>Suppliers field is empty</div>");
    }
    print("<br>");
}

include_once("../Classes/ConnectDB.php");
$connection = new ConncctDB();
$conn = $connection->connectDB();

$query = "select * from e_deals_tbl";
$result = $conn -> query($query);
print_r($query);

foreach($companies as $company){
    foreach($result as $row){
        if($company == $row['company'] && $row['stock'] > $min_stock && (float)$row['price'] > (float)$min_price ){
            $price_plus = $row['price'] + ($row['price'] * $margin) / 100;
            print("<a class='fnt'>{$row['company']} | <b>{$row['ean']}</b> | {$row['sku']} | {$row['manufacturer']} | {$row['title']} | <b>{$row['stock']}</b> | {$row['price']} | <b>$price_plus</b> | {$row['weight']} | {$row['time_stamp']}</a><br>");
        }
    }
}
    // if($supplier == $row['company']){
        // print("<a>{$row['company']}</a>");
    //  && ($min_stock > $row['stock']) && ((float)$min_price) > ((float)$row['price'])){
        // $margin_price = $row['price'] * ($min_price / 100);
        // print("<a>{$row['company']} | {$row['ean']} | {$row['sku']} | {$row['title']} | {$row['price']} | $margin_price</a>");

// $query = "select * from e_deals_tbl limit 1000, 30";
// $result = $conn->query($query);
// foreach($result as $row){
//     foreach($row as $r){
//         print("<a class='fnt nolinebrake'>{$r}&nbsp;&nbsp;</a>");
//     }
//     print("<br>");
//     // print("<div class='fnt'>{$row}</div>");
//     // print($row['id'] . $row['company'] . $row['ean'] . $row['title'] . $row['price'] . $row['time_stamp'] . "<br>");
// }

$connection->closeDB();
print("<br><br>");

?>