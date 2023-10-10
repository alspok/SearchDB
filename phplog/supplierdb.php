<?php
function supplierdb($export_for_bool, $margin, $min_stock, $min_price, $companies){
    if($companies == NULL) die("Enter at least one supplier company");
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

?>