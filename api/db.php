<?php

session_start();

// pripojenie databazi localhost
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "hovienko";

// // pripojenie databazi localhost
// $db_host = "sql313.epizy.com";
// $db_user = "epiz_34085070";
// $db_password = "3HjnQU9XRad";
// $db_name = "epiz_34085070_todos";

$con = mysqli_connect($db_host,$db_user,$db_password,$db_name);
if(!$con){
    echo"con error";
}