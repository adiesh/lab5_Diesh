<?php
    // A simple web site in Cloud9 that runs through Apache
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console
function checkDatabaseConnection() {
    $servername = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b5ba02fc3ba351";
    $password = "3f870355";
    $dbname = "heroku_860455424cb7b6b";
            
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
    //$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$conn = new mysqli($servername, $username, $password, $dbname);
    
    return $conn;
}
          
    
?>

        
            
           
  