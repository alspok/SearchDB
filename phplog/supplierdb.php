<?php
function supplierdb($margin, $min_stock, $min_price, $companies){
    if($margin == NULL and $min_stock == NULL and $min_price == NULL){
        include_once("../Classes/ConnectDB.php");
        $connection = new ConncctDB();
        $conn = $connection->connectDB();

        $query = "select * from e_supplier_tbl";
        $result = $conn -> query($query);
        while($name_row = $result->fetch_field()){
            print("<th class='ssfnt'>{$name_row->name}</th>");
        }
        while($row = $result->fetch_assoc()){
            print("tr");
            foreach($row as $item){

            }
            print("</tr>");
        }
    }
}

?>