<?php

header("Access-Control-Allow-Origin: *");

include '../db.php';

$user_id = $_SESSION["user_id"];

$sql = "
    SELECT * FROM todo
    WHERE user_id = '$user_id'
";

$result = mysqli_query($con, $sql);
$todo = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($todo);