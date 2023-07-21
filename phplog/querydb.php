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
    </header>
    <body>
        <div class="d-flex align-items-center justify-content-center" style="height: 250px;">
            <div class="p-4 m-2 text-black">
            <div class="row"><h2>Query DB</h2></div>
                <form action="" method="post">
                    <div class="row">
                        <label>Query&emsp;</label>
                        <input type="text" size="80" name="query" >
                    </div>
                    <br>
                    <div class="row">
                    <input type= "submit" class="btn center" value="Start" />
                    </div>
                </form>
                </div>
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

$server = "db-mysql-fra1-42194-do-user-14106707-0.b.db.ondigitalocean.com";
$username = "doadmin";
$password = "AVNS_IzETuacH57EOU-TThcJ";
$database = "e_deals_db";
$port = 25060;
$sslmode = "REQUIRE";

$conn = mysqli_connect($server, $username, $password, $database, $port, $sslmode);

if (!$conn){
    die("<br>Connection failed: " . mysqli_connect_error());
  }


  if (str_contains($query, 'count')){
    $result = $conn->query("select count(*) as 'count' from e_deals_tbl");
    print($count);
    }

  try{
    foreach($result as $row){
        print("<div style='font-size: 12px'>{$row['id']} | }{$row['company']} | {$row['ean']} | {$row['title']} | {$row['price']} | {$row['time_stamp']}<br></div>");
    }
  }
  catch(Exception $e) {
    print("Message: {$e->getMessage()}");
  }

  ?>
  
