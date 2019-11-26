<?php
session_start();
$id = $_REQUEST["id"];
$sql = "SELECT id FROM User_Account WHERE id = {id};";
$result = mysqli_query($_SESSION['conn'], $sql);
$row = mysqli_fetch_array($result);
echo ($row == null);