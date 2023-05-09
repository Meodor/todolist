<?php

include '../db.php';

header("Access-Control-Allow-Origin: *");

$_POST = json_decode(file_get_contents("php://input"),true);

$todo = $_POST['data'];

$change_status = $todo['doneTodo'] == 1 ? 0 : 1;
$id = $todo['id'];

$query =  "
    UPDATE todo
    SET doneTodo = $change_status
    WHERE id = $id
";

$result = mysqli_query($con, $query);
