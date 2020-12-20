<?php
//start session
session_start();

//check if user logged in
if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true ) {
 header("location: successLogin.html");
 exit;
}