<?php

session_start();

if(!isset($_SESSION['username'])) { // check whether admin has logged in. used to prevent a user where to access admin.php at the end of the url
    header("Location: admin_login.php");
}


function userList() {
    include "information.php";
    $conn = checkDatabaseConnection();
    
    $sql = "SELECT * FROM User";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
    return $records;
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page </title>
         <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
          <style>
          @import url("./CSS/styles.css"); 
          </style>
        <script>
            
            function confirmDelete() {
                return confirm("Are you sure you want to delete this user?");
            }
            
        </script>
        
    </head>
    <body>
        <h1>Admin Main: </h1>
        <h2>Welcome <?=$_SESSION['adminName']?>!</h2>

        <form action = "addUser.php">
            <input type = "submit" value = "Add new user" />
        </form>
        <br />
        <form action = "logout.php">
            <input type = "submit" value = "Logout!" />
        </form>


        <br />
        
        

        <?php
        
        $users = userList();
        
        foreach($users as $user) {
            echo $user['id'].  " " . $user['firstName']. " " . $user['lastName'];
            
            
            echo "[<a href='updateUser.php?userId=".$user['id']."'> Update </a>] <br />";
            echo "[<a onclick='return confirmDelete()' href='deleteUser.php?userId=".$user['id']."'> Delete </a>] <br />";
        }
        
        ?>
    </body>
</html>