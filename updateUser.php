<?php

session_start();

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}


include 'information.php';

$conn = checkDatabaseConnection();

function getUserInfo() {
    global $conn;
    
    $sql = "SELECT * FROM User WHERE id = " . $_GET['userId'];
    
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();
    
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($record);
    return $record;
}


function departmentList(){
    global $conn;
    
    $sql = "SELECT * FROM Departments ORDER BY name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
    
    
}


if (isset($_GET['updateUser'])) {
    // echo "Form has been submitted!"
    
    
    $sql = "UPDATE User SET firstName = :fName, lastName = :lName WHERE userId = :userId";
    
    $np = array();
    
    $np[':fName'] = $_GET['firstName'];
    $np[':lName'] = $_GET['lastName'];
    $np[':id'] = $_GET['userId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    echo "Record has been updated";
}


if(isset($_GET['userId'])) {
    $userInfo = getUserInfo();
}

if(isset($_GET['deptId'])) {
    $userInfo = getUserInfo();
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title> Update User</title>
    </head>
    <body>
         <h1> Tech Checkout System: Adding a New User </h1>
        <form method="POST">
            User Id: <input type="text" name="userId" />
            <br />
            First Name:<input type="text" name="firstName" value = "<?=$userInfo['firstName']?>"/>
            <br />
            Last Name:<input type="text" name="lastName" value = "<?=$userInfo['lastName']?>"/>
            <br/>
            Email: <input type= "email" name ="email" value = "<?=$userInfo['email']?>"/>
            <br/>
            Phone Number: <input type ="text" name= "phone" value = "<?=$userInfo['phone']?>"/>
            <br />
           Role: 
           <select name="role">
                <option value=""> - Select One - </option>
                <option value="staff" <?=($userInfo['role'] == 'Staff')? " selected": "" ?> >Staff</option>
                <option value="student" <?=($userInfo['role'] == 'Student')?" selected" : "" ?> >Student</option>
                <option value="faculty" <?=($userInfo['role'] == 'Faculty')?" selected" : "" ?> >Faculty</option>
            </select>
            <br />
            Department: 
            <select name="deptId">
                <option value="" > Select One </option>
                <!-- add departments here!!!-->
                <option value = "computer science" <?=($userInfo['id']=='1')?" selected":"" ?> >computer science</option>
                <option value = "Statistics" <?=($userInfo['id']=='2')?" selected":"" ?> >Statistics</option>
                <option value = "Design" <?=($userInfo['id']=='3')?" selected":"" ?> >Design</option>
                <option value = "Economics" <?=($userInfo['id']=='4')?" selected":"" ?> >Economics</option>
                <option value = "Drama" <?=($userInfo['id']=='5')?" selected":"" ?> >Drama</option>
                <option value = "Biology" <?=($userInfo['id']=='6')?" selected":"" ?> >Biology</option>
            </select>
            <input type="submit" value="Update User" name="updateUser">
            <br />
            <input type="submit" value="Back to Admin Main" name="addUser">
        </form>

    </body>
</html>