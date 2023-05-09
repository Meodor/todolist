<?php

include '../db.php';

$password = $_POST['password'];

$email = $_POST['email'];

$sql = "
    SELECT * FROM user
    WHERE password = '$password'
    AND email = '$email'
";

$result = mysqli_query($con, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

if($data == []){
    echo("Nesprávny email alebo heslo");
    die();
}

$_SESSION["user_id"] = $data[0]['id'];
header("Location: ../../index.php");

