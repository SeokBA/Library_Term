<?php
// 유저가 현재 가진 책을 반환 후 삭제
$id = $_REQUEST["id"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "DELETE FROM User_Account WHERE (id = {$id});";
$result = mysqli_query($conn, $sql);
echo 1;