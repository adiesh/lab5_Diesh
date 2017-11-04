<?php

session_start(); // starts or resumes a session

function loginProcess() {
    
    if (isset($_POST['loginForm'])) { // checks if form has been submitted.
       
       #include '../../information.php';
       
       include "information.php";
       
       $conn = checkDatabaseConnection();
       // echo "form has been submitted";
       // print_r($_POST['username']);
       
       $username = $_POST['username'];
       $password = sha1($_POST['password']);
       
       //$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'"; this can result in sql injection. BE CAREFUL
       $sql = "SELECT * FROM Admin WHERE username = :username AND password = :password"; // to prevent sql injection.
       //echo $sql;
       
       $namedParameters = array();
       $namedParameters[':username'] = $username;
       $namedParameters[':password'] = $password;
       
       
       
       $stmt = $conn->prepare($sql);
       $stmt->execute($namedParameters); // Fatal error: Call to a member function execute() on a non-object in /home/ubuntu/workspace/CST336/admin_login.php on line 31 Call Stack: 0.0006 237768 1
       $record = $stmt->fetch();
       
       if (empty($record)) {
           echo "Wrong username or password";
       } else {
           $_SESSION['username'] = $record['userName'];
           $_SESSION['adminName'] = $record['firstName']. " " . $record['lastName'];
           //echo $record['firstName'];
           header("Location: admin.php"); // redirecting to admin.php
           //echo "login successful";
       }
       
       //print_r($record);
    }

}
?>


<html>
    <head>
        <title>Admin Login</title>
         <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
          <style>
          @import url("./CSS/styles.css"); 
          </style>
    </head>
    <body>
        <h1>Admin Login</h1>
        
        <form method = "post">
            Username: <input type = "text" name = "username"><br />
            Password: <input type = "password" name = "password"><br>
            <input type = "submit" name = "loginForm" value = "Login!"><br />
            
        </form>
        
        <br />
        
        <?=loginProcess()?>
        
    </body>
    
    
</html>