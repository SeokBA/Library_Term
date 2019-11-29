<?php
$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "SELECT * FROM User_Account";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

echo $row;