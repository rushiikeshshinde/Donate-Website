<?php
//php script for log out
//start session
session_start();
 
//session variables
$_SESSION = array();
 
//close session.
session_destroy();
 
//lead to login page
header("location: login.php");
exit;
?>