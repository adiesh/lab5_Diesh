<?php

   include 'information.php'; 
   
   // https://cst336-lab5-adiesh.c9users.io/phpMyAdmin/
   
   function displayListOfDevices() {
       
       $sql = "SELECT * from device WHERE 1"; // another way to select all attributes. 1: boolean, true.
       $namedParameters = array(); 
       
       if (isset($_GET['submit'])) { // check if the user did a search. 
            // now we check if any of the forms were filled out. 
           if (!empty($_GET['device-name'])) {
               // construct our SQL query accordingly.
               $sql .=  " AND deviceName LIKE :deviceName"; 
               $namedParameters[":deviceName"] = "%" . $_GET['device-name'] . "%"; // if a user enters a set of characters, it should give you a list containing those letters (ip: iPad, iPhone, etc)
           }
           
           if (!empty($_GET['device-type'])) {
               // construct our SQL query accordingly.
               $sql .=   " AND deviceType = '". $_GET['device-type'] . "'"; 
           }
           
           if (isset($_GET['available'])) {
               // construct our SQL query accordingly.
               $sql .=   " AND status = 'available'"; 
           }
           
           if (isset($_GET['order-by'])) {
               // construct our SQL query accordingly.
               $sql .=   " ORDER BY ". $_GET['order-by']; 
           }
           
           
       }
       $dbConn = checkDatabaseConnection(); 
   
       
       $statement = $dbConn->prepare($sql);
       $statement->execute($namedParameters);
        
       $records = $statement->fetchAll(); 
        
       foreach ($records as $record) {
            echo $record["deviceName"]." ".$record["deviceType"]." ".$record["price"]." ".$record["status"]."<br>"; 
       }
   }
   
   function getDeviceTypes() {
        $dbConn = checkDatabaseConnection();  // get the database connection.
        $sql = 'SELECT DISTINCT(deviceType)  FROM device;'; 
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        
        $records = $statement->fetchAll(); 
        
        foreach ($records as $record) {
            echo "<option value='". $record['deviceType']. "'>". $record['deviceType']. "</option>"; 
        }
   }
  
  ?>
  
  
  <html>
      <head>
          <title>Checkout Tech Devices</title>
          <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
          <style>
          @import url("./CSS/styles.css"); 
          </style>
      </head>
      <body>
          <header>
              	<h1>Choose a device: </h1>
          </header>
          <form>
               <strong><i>Device Name: </i></strong><input type="text" name="device-name">
               <br>
               <br>
               <strong><i>Device Type: </i></strong> 
               <select name="device-type">
                     <option value=""></option>
                     <?=getDeviceTypes()?>
               </select>
               <br>
               <br>
               <input type="checkbox" name="available"> <strong><i>Available: </i></strong>
               <br>
               <br>
               <input type="radio" name="order-by" value="price"> <strong><i>Order By Price: </i></strong>
               <br>
               <br>
               <input type="radio" name="order-by" value="deviceName"> <strong><i>Order By Name: </i></strong>
               <br>
               <br>
               <input type="submit" value="Search" name="submit">
          </form>
          
          <?=displayListOfDevices()?> <!-- calling displayListOfDevices(). Used to display all devices within devices schema
      </body>
  </html>