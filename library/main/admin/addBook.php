<?php
$isbn = $_REQUEST["isbn"];
$name = $_REQUEST["name"];
$author = $_REQUEST["author"];
$publisher = $_REQUEST["publisher"];



$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "SELECT * FROM Book_Statement;";
$result = mysqli_query($conn, $sql);
$book_id = $result->num_rows;
$book_id++;

$sql = "SELECT * FROM Book_Information WHERE ISBN = '{$isbn}';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$len = $result->num_rows;
if($len == 0){
    $sql = "INSERT INTO Book_Information(ISBN, name, author, publisher) VALUES ({$isbn}, '{$name}', '{$author}', '{$publisher}');";
    $result = mysqli_query($conn, $sql);
}

$sql = "INSERT INTO Book_Statement(book_id, ISBN, reservation_chk) VALUES ({$book_id}, {$isbn}, 0);";
$result = mysqli_query($conn, $sql);
echo $sql;
echo 1;