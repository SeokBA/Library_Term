<?php
session_start();
$id = $_POST["id"];
$sql = "select password from User_Account where id = '{$id}';";
$result = mysqli_query($_SESSION['conn'], $sql);
$row = mysqli_fetch_array($result);
$dataPW = $row['password'];
echo $dataPW;