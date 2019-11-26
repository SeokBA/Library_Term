<?php
$id = $_REQUEST["idSignUpBox"];
$pw = $_REQUEST["pwSignUpBox"];
$name = $_REQUEST["nameSignUpBox"];
$email = $_REQUEST["emailSignUpBox"];
$phone = $_REQUEST["phoneSignUpBox"];
$classification = $_GET["classificationSignUpBox"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "SELECT * FROM User_Account WHERE id = '{$id}';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
var_dump($result->num_rows);
echo "<h1>hi</h1>";
echo "<h2>$result</h2>";
echo "<h3>$row</h3>";

//$sql = "INSERT INTO 'LB_DB'.'User_Account' ('id', 'password', 'name', 'email', 'phone', 'classification') VALUES ('{$id}', '{$pw}', '{$name}', '{$email}', '{$phone}', '{$classification}');";
//$result = mysqli_query($_SESSION['conn'], $sql);
//echo ("<script> alert('Done') </script>");