<?php
// 유저가 현재 가진 책이 없을 경우, 삭제
$id = $_REQUEST["id"];
$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "SELECT * FROM Book_Statement WHERE id = '{$id}';";
$result = mysqli_query($conn, $sql);
if($result->num_rows != 0)
     echo 2;
else{
     $sql = "DELETE FROM User_Account WHERE id = '{$id}';";
     $result = mysqli_query($conn, $sql);
     echo 1;
}
?>
