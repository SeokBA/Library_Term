<?php
$book_id = $_REQUEST["book_id"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');

$sql = "DELETE FROM Book_Statement WHERE book_id = {$book_id};";
$result = mysqli_query($conn, $sql);
echo 1;