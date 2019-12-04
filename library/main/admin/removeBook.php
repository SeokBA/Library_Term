<?php
// 책이 대출중이거나 예약중이면 안됨
$book_id = $_REQUEST["book_id"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "SELECT reservation_chk FROM Book_Statement WHERE book_id = {$book_id};";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($result);
if($result['reservation_chk'] != 0)
    echo 2;
else{
    $sql = "DELETE FROM Book_Statement WHERE book_id = {$book_id};";
    $result = mysqli_query($conn, $sql);
    echo 1;
}