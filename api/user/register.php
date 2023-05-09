<?php

include '../db.php';

$password = $_POST['password'];
$email = $_POST['email'];

$query_select = "
    SELECT * FROM user
    WHERE email = '$email'
";

$result = mysqli_query($con,$query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

if($data != []){
    die('email uz existuje');
};

$query_insert = "
    INSERT INTO user (password, email)
    VALUES ('$password', '$email')
";

$result = mysqli_query($con, $query);

header("Location: ../../login.html");