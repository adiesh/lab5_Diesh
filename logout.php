<?php
session_start();


session_destroy();


// take them back to login screen


header("Location: admin_login.php");




?>