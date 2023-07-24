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
                        <select name="export_for"> 
                            <option value="no_selection"></option> 
                            <option value="varle">Varle</option> 
                            <option value="pigu">Pigu</option> 
                            <option value="kazkas">Kazkas</option> 
                        </select>
                        <!-- <input type="text" id ="user" name="export_for" />   -->
                    </p>  
                    <p>  
                        <label> File name </label><br>  
                        <input type="text" name="file_name" placeholder="*.export.csv"/>  
                    </p>  
                    <p>  
                        <label> Margin % </label><br>
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
                        <label> Suppliers </label><br>
                        <select name="suppliers" multiple>
                            <option value="gitana"> Gitana </option>
                            <option value="action"> Action </option>
                            <option value="appolo"> Appolo </option>
                            <option value="domitech"> Domitech </option>
                            <option value="nzd"> Nzd </option>
                            <option value="verkkakoupa"> Verkkakoupa </option>
                        </select>
                        <!-- <input type="textd" name = "suppliers" />   -->
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
    if(empty($export_for == '')){
      print("<div class='fnt'>Export for is empty</div>");
    }
    $file_name = $_POST['file_name'];
    if(empty($file_name)){
        print("<div class='fnt'>File name field is empty</div>");
    }
    $margin = $_POST['margin'];
    if(empty($margin)){
        print("<div class='fnt'>Margin field is empty</div>");
    }
    $min_stock = $_POST['min_stock'];
    if(empty($min_stock)){
        print("<div class='fnt'>Min stock field is empty</div>");
    }
    $min_price = $_POST['min_price'];
    if(empty($min_price)){
        print("<div class='fnt'>Min price field is empty</div>");
    }
    $suppliers = $_POST['suppliers'];
    if(empty($suppliers)){
        print("<div class='fnt'>Suppliers field is empty</div>");
    }
    print("<br>");
}

include_once("../Classes/ConnectDB.php");
// include("/var/www/html/SearchDB/Classes/ConnectDB.php");
$connection = new ConncctDB();
$conn = $connection->connectDB();

$query = "select * from e_deals_tbl limit 1000, 1";
$result = $conn->query($query);
foreach($result as $row){
    foreach($row as $r){
        print("<span class='fnt'>{$r}</span>&nbsp;&nbsp;");
    }
    print("<br>");
    // print("<div class='fnt'>{$row}</div>");
    // print($row['id'] . $row['company'] . $row['ean'] . $row['title'] . $row['price'] . $row['time_stamp'] . "<br>");
}

$connection->closeDB();
print("<br><br>");

?>