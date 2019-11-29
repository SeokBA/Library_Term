<?php
// 대출 반납한 책의 reservation_chk를 확인 함
// 예약이 없으면 0으로 바꾸고, 예약 있으면 다음 예약으로 넘김
$borrow_id = $_REQUEST["borrow_id"];
$book_id = $_REQUEST["book_id"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');

$sql = "SELECT * FROM Reservation_Information WHERE book_id = {$book_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($row["reservatoin_chk"] == 1)