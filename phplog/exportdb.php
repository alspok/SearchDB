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
                            <p>  
                                <label class='label-fnt'> File name  <span class="sfnt">(*.export.csv )</span> </label><br>  
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

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $export_for = $_POST['export_for'];
                            if($export_for == NULL){
                                $export_for_bool = FALSE;
                                print("<div class='csfnt'><b>'Export for'</b> is empty</div>");
                            }
                            else{
                                $export_for_bool = TRUE;
                            }
                            $file_name = $_POST['file_name'];
                            if($file_name == NULL){
                                $file_name_bool = FALSE;
                                print("<div class='csfnt'><b>'File name'</b> field is empty</div>");
                            }
                            else{
                                $file_name_bool = TRUE;
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
                        var_dump($export_for_bool);
                        var_dump($file_name);
                        $fhw = fopen($file_name, "w");

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
                    }
                    else{
                        print("<div class='csfnt'>Enter export file name</div>");
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


