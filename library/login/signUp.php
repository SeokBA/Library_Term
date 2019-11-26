<?php
session_start();
$id = $_REQUEST["idSignUpBox"];
$pw = $_REQUEST["pwSignUpBox"];
$name = $_REQUEST["nameSignUpBox"];
$email = $_REQUEST["emailSignUpBox"];
$phone = $_REQUEST["phoneSignUpBox"];
$classification = $_GET["classificationSignUpBox"];
echo $id;

$sql = "SELECT * FROM User_Account WHERE id = '{$id}';";
$result = mysqli_query($_SESSION['conn'], $sql);
if ($row != null)
    echo ("<script> alert('Duplicate ID') </script>");

$sql = "INSERT INTO 'LB_DB'.'User_Account' ('id', 'password', 'name', 'email', 'phone', 'classification') VALUES ('$id', '$pw', '$name', '$email', '$phone', '$classification');";
$result = mysqli_query($_SESSION['conn'], $sql);
echo ("<script> alert('Done') </script>");