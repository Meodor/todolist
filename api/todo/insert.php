<?php

include '../db.php';

header("Access-Control-Allow-Origin: *");

$_POST = json_decode(file_get_contents("php://input"),true);

$todo = $_POST['todos'];
$user_id = $_SESSION["user_id"];

$query =  "INSERT INTO todo (todos, user_id) VALUES ('$todo', '$user_id')";

$result = mysqli_query($con, $query);