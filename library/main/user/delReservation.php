<?php
$book_id = $_REQUEST["bookId"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "select * from Reservation_Information;";
$result = mysqli_query($conn, $sql);


$sql = "select id from Reservation_Information where book_id = {$book_id};"; #book_id 가져오기
$result = mysqli_query($conn, $sql);


$sql = "UPDATE Book_Statement SET reservation_chk = 4 WHERE (book_id = {$book_id}); ";
$result = mysqli_query($conn, $sql);

echo 1;