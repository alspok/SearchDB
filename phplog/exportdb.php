<html>
    <head>
        <title>Ledynas login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "style.css">   
    </head>
    <header>
            <img src="Ledynas_logo.png" width="300" height="100">
    </header>
    <body>
        <div class="d-flex align-items-center justify-content-center">
            <form action="" method="post">
                <h2>Export file</h2>
                    <p>  
                        <label> File name </label><br>  
                        <input type="text" id ="user" name="user" />  
                    </p>  
                    <p>  
                        <label> Margin % </label><br>
                        <input type="password" id="pass" name = "pass" />  
                    </p>
                    <p>  
                        <label> Min stock </label><br>
                        <input type="password" id="pass" name = "pass" />  
                    </p>
                    <p>
                        <label> Min price </label><br>
                        <input type="password" id="pass" name = "pass" />  
                    </p>  
                    <p>
                        <label> No suppliers </label><br>
                        <input type="password" id="pass" name = "pass" />  
                    </p>  
                    <p>     
                        <input type= "submit" class="btn" value="Export" />
                    </p>  
            </form>
        </div>
    </body>
    <footer>
        &copy; <em id="date"></em> 2023
    </footer>
</html>
