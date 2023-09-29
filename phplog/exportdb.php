<html>
    <head>
        <title>Ledynas export</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
    </head>
    <header>
            <div style="text-align: left">
                <img width="400" src="Ledynas_logo.png" >
            </div>
    </header>
    <div class='container'>
        <body>
            <div class="row d-flex align-items-center justify-content-center">
                <div class='col-auto border border-2'>
                    <form action="" method="post">
                        <h6>Export file</h6>
                            <p>  
                                <label class='label-fnt'>Export for</label><br>
                                <select name="export_for" style="width: 190px" size="3" > 
                                    <option class='sfnt' value="varle">Varle</option> 
                                    <option class='sfnt' value="pigu">Pigu</option> 
                                    <option class='sfnt' value="kazkas">Kazkas</option> 
                                </select>
                                <!-- <input type="text" id ="user" name="export_for" />   -->
                            </p>  
                            <p>  
                                <label class='label-fnt'> File name  <span class="sfnt">( extention *.export.csv )</span> </label><br>  
                                <input class='sfnt' type="text" name="file_name" />  
                            </p>  
                            <p>  
                                <label class='label-fnt'> Margin <span class="sfnt">( % )</span></label><br>
                                <input class='sfnt' type="text" name = "margin" />  
                            </p>
                            <p>  
                                <label class='label-fnt'> Min stock </label><br>
                                <input class='sfnt' type="text" name = "min_stock" />  
                            </p>
                            <p>
                                <label class='label-fnt'> Min price </label><br>
                                <input class='sfnt' type="text" name = "min_price" />  
                            </p>  
                            <p>
                                <label class='label-fnt'> Suppliers <span class="sfnt">( 'ctr' for multiple selection )</span> </label><br>
                                <select name="companies[]" style="width:190px" size="8" multiple>
                                    <option class='sfnt' value="Gitana"> Gitana </option>
                                    <option class='sfnt' value="Action"> Action </option>
                                    <option class='sfnt' value="Appolo"> Appolo </option>
                                    <option class='sfnt' value="Domitech"> Domitech </option>
                                    <option class='sfnt' value="Nzd"> Nzd </option>
                                    <option class='sfnt' value="Verkkokouppa"> Verkkokouppa </option>
                                    <option class='sfnt' value="Cyberport"> Cyberport </option>
                                    <option class='sfnt' value="EETeuroparts"> EETeuroparts </option>
                                </select>
                            </p>  
                            <p>     
                                <input type= "submit" class="btn" value="Export" />
                            </p>  
                    </form>
                </div>
                <div class='col-auto sfnt border border-2'>
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
                                print("<a class='sfnt'><b>{$file}.export.csv</b> created at: {$cdate}</a></br>");
                            }
                        }
                        print("<br><br>");
                    include_once("../Classes/ConnectDB.php");
                    $connection = new ConncctDB();
                    $conn = $connection->connectDB();

                    $query = "select * from e_supplier_tbl";
                    $result = $conn -> query($query);

                    print("<table class='h-auto d-inline-block w-auto p-3'>");
                    print("<tr>");
                    while ($field_info = $result->fetch_field()){
                        print("<th class='sfnt'>{$field_info->name}</th>");
                    }
                    print("</tr>");
                    $suplier_array = array();
                    while($row = $result->fetch_row()){
                        print("<tr>");
                        foreach($row as $item){
                            print("<td class='sfnt'>{$item}</td>");
                        }
                        print("</tr>");
                    }
                    print("</table>");

                    $result->free_result();
                    $connection->closeDB();
                    print("<br><br>");
                    ?>
                </div>
            </div>
            <div class="row d-flex align-items-center justify-content-left">
                <div class='col-auto sfnt border border-2'>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $export_for = $_POST['export_for'];
                        if($export_for == NULL){
                        print("<div class='csfnt'>Export for is empty</div>");
                        }
                        $file_name = $_POST['file_name'];
                        if($file_name == NULL){
                            print("<div class='csfnt'>File name field is empty</div>");
                        }
                        $margin = $_POST['margin'];
                        if($margin == NULL){
                            print("<div class='csfnt'>Margin field is empty</div>");
                        }
                        $min_stock = $_POST['min_stock'];
                        if($min_stock == NULL){
                            print("<div class='csfnt'>Min stock field is empty</div>");
                        }
                        $min_price = $_POST['min_price'];
                        if($min_price == NULL){
                            print("<div class='csfnt'>Min price field is empty</div>");
                        }
                        $companies = $_POST['companies'];
                        if($companies == NULL){
                            print("<div class='csfnt'>Suppliers field is empty</div>");
                        }
                        print("<br>");
                    }

                    include_once("../Classes/ConnectDB.php");
                    $connection = new ConncctDB();
                    $conn = $connection->connectDB();

                    $query = "select * from e_deals_tbl";
                    $result = $conn -> query($query);
                    print("<a>{$query}</a>,<br>");

                    print("<table class='h-auto d-inline-block w-auto p-3'>");
                    print("<tr>");
                    while ($field_info = $result->fetch_field()){
                        print("<th class='ssfnt'>{$field_info->name}</th>");
                    }
                    print("</tr>");

                    while($row = $result->fetch_row()){
                        // var_dump("<a>{$row[1]}</a><br>}");
                        if(in_array($row[1], $companies)){
                            print("<tr>");
                            foreach($row as $item){
                                print("<td class='ssfnt'>{$item}</td>");
                            }
                            print("</tr>");
                        }
                    }
                    print("</table>");

                    $result->free_result();
                    $connection->closeDB();
                    ?>
                </div>
            </div>
        </body>
    </div>
    <footer>
        &copy; <div class='sfnt'><em id="date"></em> 2023</div>
    </footer>
</html>


