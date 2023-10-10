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
    <div class='container-fluid'>
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
                            <!-- <p>  
                                <label class='label-fnt'> File name  <span class="sfnt">(*.export.csv )</span> </label><br>  
                                <input class='sfnt' type="text" name="file_name" />  
                            </p>   -->
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
                                    <option class='sfnt' value="Apollo"> Apollo </option>
                                    <option class='sfnt' value="Domitech"> Domitech </option>
                                    <option class='sfnt' value="NZD"> NZD </option>
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

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $export_for = $_POST['export_for'];
                            if($export_for == NULL){
                                $export_for_bool = FALSE;
                                print("<div class='csfnt'><b>'Export for'</b> is empty</div>");
                            }
                            else{
                                $export_for_bool = TRUE;
                            }
                            $margin = $_POST['margin'];
                            if($margin == NULL){
                                $margin_bool = FALSE;
                                print("<div class='csfnt'><b>'Margin'</b> field is empty</div>");
                            }
                            else{
                                $margin_bool = TRUE;
                            }
                            $min_stock = $_POST['min_stock'];
                            if($min_stock == NULL){
                                $min_stock_bool = FALSE;
                                print("<div class='csfnt'><b>'Min stock'</b> field is empty</div>");
                            }
                            else{
                                $min_stock_bool = TRUE;
                            }
                            $min_price = $_POST['min_price'];
                            if($min_price == NULL){
                                $min_price_bool = FALSE;
                                print("<div class='csfnt'><b>'Min price'</b> field is empty</div>");
                            }
                            else{
                                $min_price_bool = TRUE;
                            }
                            $companies = $_POST['companies'];
                            if($companies == NULL){
                                $companies_bool = FALSE;
                                print("<div class='csfnt'><b>'Suppliers'</b> field is empty</div>");
                            }
                            else{
                                $companies_bool = TRUE;
                            }
                        }
                        
                        include_once("supplierdb.php");
                        supplierdb($margin, $min_stock, $min_price, $companies);

                        ?>
                </div>
            </div>

            <div class='row' style=width: 100%>
                <div class='col-auto sfnt border border-2'>
                    <?php
                    include_once("../Classes/ConnectDB.php");
                    $connection = new ConncctDB();
                    $conn = $connection->connectDB();

                    $query = "select * from e_deals_tbl";
                    $result = $conn -> query($query);
                    
                    if($export_for_bool){
                        $file_name = "../ExportFiles/{$export_for}/{$export_for}.export.csv";
                        $fhw = fopen($file_name, "w");
                        chmod($file_name, 0666);
                        if(!$fhw)  die("The file can't be open for writing<br>");

                        print("<table class='h-auto d-inline-block w-auto p-3'>");
                        print("<tr>");
                        $field_name = array("ean", "company", "manufacturer", "title", "stock", "price");
                        $field_line = "";

                        while($field_info = $result->fetch_field()){
                            print("<th class='ssfnt'>{$field_info->name}</th>");
                            // if(in_array($field_info->name, $field_name)){
                            //     $field_line .= "{$field_info->name};";
                            }
                            // else{
                            //     continue;
                            // }
                        // }
                        print("</tr>");

                        $field_line = substr($field_line, 0, -1);
                        $field_line .= "\r\n";
                        fwrite($fhw, $field_line);
                        fclose($fhw);

                        $fha = fopen("{$file_path}{$file_name}", "a");
                        while($row = $result->fetch_assoc()){
                            $row_line = "";
                            if(in_array($row['company'], $companies)){
                                print("<tr>");
                                print("<td class='ssfnt'>{$row['id']}</td>");
                                print("<td class='ssfnt'>{$row['company']}</td>");
                                $row_line .= $row['company'] . ";";
                                print("<td class='ssfnt'>{$row['ean']}</td>");
                                $row_line .= $row['ean'] . ";";
                                print("<td class='ssfnt sku'>{$row['sku']}</td>");
                                print("<td class='ssfnt category'>{$row['category']}</td>");
                                print("<td class='ssfnt manufacturer'>{$row['manufacturer']}</td>");
                                $row_line .=$row['manufacturer'] . ";";
                                print("<td class='ssfnt title'>{$row['title']}</td>");
                                $row_line .= $row['title'] . ";";
                                print("<td class='ssfnt'>{$row['stock']}</td>");
                                $row_line .= $row['stock'] . ";";
                                print("<td class='ssfnt'>{$row['price']}</td>");
                                print("<td class='ssfnt'>{$row['weight']}</td>");
                                print("<td class='ssfnt'>{$row['time_stamp']}</td>");
                                $row_line .= $row['price'] . "\r\n";
                                print("</tr>");
                                print("<tr style='color: blue'>");
                                print("<td class='ssfnt'></td>");
                                print("<td class='ssfnt'>{$row['company']}</td>");
                                print("<td class='ssfnt'>{$row['ean']}</td>");
                                print("<td class='ssfnt'></td>");
                                print("<td class='ssfnt'></td>");
                                print("<td class='ssfnt'>{$row['manufacturer']}</td>");
                                print("<td class='ssfnt'>{$row['title']}</td>");
                                print("<td class='ssfnt'>{$row['stock']}</td>");
                                print("<td class='ssfnt'>{$row['price']}</td>");
                                print("<td class='ssfnt'></td>");
                                print("<td class='ssfnt'></td>");
                                print("</tr>");
                            }
                            fwrite($fha, $row_line);
                        }   

                        print("</table>");
                        fclose($fha);

                        $result->free_result();
                        $connection->closeDB();
                    }
                    ?>
                </div>
            </div>
        </body>
    </div>
    <footer>
        &copy; <div class='sfnt'><em id="date"></em> 2023</div>
    </footer>
</html>


