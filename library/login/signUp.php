<?php
session_start();
$id = $_POST["id"];
$pw = $_POST["pw"];
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$classification = $_POST["classification"];
$sql = "INSERT INTO 'LB_DB'.'User_Account' ('id', 'password', 'name', 'email', 'phone', 'classification') VALUES ('{$id}', '{$pw}', '{$name}', '{$email}', '{$phone}', '{$classification}');";
$result = mysqli_query($_SESSION['conn'], $sql);
echo $result;