<?php
session_start();
$_SESSION['conn'] = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "select * from Book_Information;";
$result = mysqli_query($_SESSION['conn'], $sql);
var_dump($result);