<?php
function supplierdb($margin, $min_stock, $min_price, $companies){
    if($companies == NULL) die("<a class='sfnt'>Enter at least one supplier company</a>");
    if($export_for_bool){
        if($margin == NULL and $min_stock == NULL and $min_price == NULL){
            include_once("../Classes/ConnectDB.php");
            $connection = new ConncctDB();
            $conn = $connection->connectDB();

            $query = "select * from e_supplier_tbl";
            $result = $conn -> query($query);
            print("<table class='h-auto d-inline-block w-auto p-3'>");
            while($name_row = $result->fetch_field()){
                print("<th class='sfnt'>{$name_row->name}</th>");
            }
            while($row = $result->fetch_assoc()){
                print("<tr>");
                foreach($row as $item){
                    print("<td class='sfnt'>{$item}</td>");
                }
                print("</tr>");
            }
            print("<table>");
            $result->free_result();
            $connection->close();
        }
    }
    else{
        die("<a class='sfnt'>Enter export company</a>");
    }
}

function supplierUpdateDB($margin, $min_stock, $min_price, $companies){
    include_once("../Classes/ConnectDB.php");
            $connection = new ConncctDB();
            $conn = $connection->connectDB();

            foreach($companies as $company){
                $query = "update e_supplier_tbl set company={$company}, margin={$margin}, min_price={$min_price}, min_stock={$min_stock}";
                $conn -> query($query);
            }

            $connection->close();

}

?>