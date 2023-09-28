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
        <br>
    <div class="container">
        <body class="sfnt">
            <!-- <div class="p-4 m-2 text-black"> -->
            <div class="row border border-2"><h5>Query DB</h5></div>
                <div class="row border border-2 justify-content-left">
                    <label><h6>Query&emsp;</h6></label>
                <form class='form-inline' action="" method="post">
                    <div class='col-sm-6'>
                        <input type="text" size="80" name="query"/>
                    </div>
                    <div class='col-sm-6'>
                        <input type= "submit" class="btn" value="Submit"/>
                    </div>
                </form>
            </div>

            <div class="row border border-2">
                <label for="freeform"><h6>Query examples&emsp;</h6></label>
                <br><br>
                <textarea id="freeform" name="freeform" rows="14" cols="100">
            SHOW databases;
            USE [database_name];
            SHOW tables;
            ------------------------------------
            SELECT * FROM [table_name];
            SELECT * FROM [table_name] LIMIT [rows_number];
            SELECT count(*) FROM [table_name];
            SELECT count(*) FROM [table_name] WHERE [column_name]=[name];
            SELECT DISTINCT [name] FROM [table_name];
            ------------------------------------
            INSERT INTO [table] ([column_name1], [column_name2], ...) VALUES ([value1], [value2], ...);
            ------------------------------------
                </textarea>
            </div>
        </div>
    </body>
    <footer>
        &copy; <em id="date"></em> 2023
    </footer>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = $_POST['query'];
}

// $server = "db-mysql-fra1-42194-do-user-14106707-0.b.db.ondigitalocean.com";
// $username = "doadmin";
// $password = "AVNS_IzETuacH57EOU-TThcJ";
// $database = "e_deals_db";
// $port = 25060;
// $sslmode = "REQUIRE";

// $conn = mysqli_connect($server, $username, $password, $database, $port, $sslmode);

// if (!$conn){
//     die("<br>Connection failed: " . mysqli_connect_error());
//   }

include_once("../Classes/ConnectDB.php");
$connection = new ConncctDB();
$conn = $connection->connectDB();

print("<div class='sfnt'><b>Query:</b> {$query}</div>");
$result = $conn->query($query);

echo "<table class='h-auto d-inline-block w-auto p-3'>";
echo "<tr>";
while ($field_info = $result->fetch_field()) {
    // var_dump($field_info);
    printf("<th class='sfnt'>%s</th>", $field_info->name);
}
echo "</tr>";
while($row = $result->fetch_row()){
    echo "<tr>";
    foreach($row as $item){
        print("<td class='sfnt'>{$item}</td>");
    }
    echo "</tr>";
}
echo "</table>";

$connection -> closeDB();

?>