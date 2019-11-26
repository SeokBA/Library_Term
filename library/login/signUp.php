<?php
session_start();
$id = $_REQUEST["id"];
$pw = $_REQUEST["pw"];
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$classification = $_GET["classification"];
$sql = "INSERT INTO 'LB_DB'.'User_Account' ('id', 'password', 'name', 'email', 'phone', 'classification') VALUES ('$id', '$pw', '$name', '$email', '$phone', '$classification');";
$result = mysqli_query($_SESSION['conn'], $sql);
echo $result;