<?php

include '../db.php';

header("Access-Control-Allow-Origin: *");

$_POST = json_decode(file_get_contents("php://input"),true);

$todo = $_POST['data'];

$id = $todo['id'];

$query =  "
    DELETE FROM todo
    WHERE id = $id
";

$result = mysqli_query($con, $query);