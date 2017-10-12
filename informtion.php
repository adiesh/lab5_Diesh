<html>
    <body>
    <?php
    // A simple web site in Cloud9 that runs through Apache
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console
    
            $servername = "localhost";
            $username = "adiesh";
            $password = "indie1";
            $dbname = "tech_devices_app";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            echo "Connected successfully";
            
    
    ?>
    </body>
</html>