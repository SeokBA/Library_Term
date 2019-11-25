<?php
session_start();
$id = $_GET["id"];
$pw = $_GET["pw"];
$name = $_GET["name"];
$email = $_GET["email"];
$phone = $_GET["phone"];
$classification = $_GET["classification"];
$sql = "INSERT INTO 'LB_DB'.'User_Account' ('id', 'password', 'name', 'email', 'phone', 'classification') VALUES ('{$id}', '{$pw}', '{$name}', '{$email}', '{$phone}', '{$classification}');";
$result = mysqli_query($_SESSION['conn'], $sql);
echo $result;