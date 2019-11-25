<?php
session_start();
$id = $_GET["id"];
$sql = "select * from User_Account where id = '{$id}';";
$result = mysqli_query($_SESSION['conn'], $sql);
$row = mysqli_fetch_array($result);
echo $row["password"];
