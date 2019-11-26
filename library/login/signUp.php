<?php
$id = $_REQUEST["id"];
$pw = $_REQUEST["pw"];
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$classification = $_GET["classification"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "SELECT * FROM User_Account WHERE id = '{$id}';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($result->num_rows == 1)
    echo 0;
else {
    $sql = "INSERT INTO 'LB_DB'.'User_Account' ('id', 'password', 'name', 'email', 'phone', 'classification') VALUES ('{$id}', '{$pw}', '{$name}', '{$email}', '{$phone}', '{$classification}');";
    $result = mysqli_query($conn, $sql);
    echo 1;
}