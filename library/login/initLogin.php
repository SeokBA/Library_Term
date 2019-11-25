<?php
session_start();
$_SESSION['conn'] = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');

$sql = "select password from User_Account where id = 'admin';";
$result = mysqli_query($_SESSION['conn'], $sql);
$row = mysqli_fetch_array($result);
echo $row;