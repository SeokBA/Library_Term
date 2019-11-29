<?php
$isbn = $_REQUEST["isbn"];
$name = $_REQUEST["name"];
$author = $_REQUEST["author"];
$publisher = $_REQUEST["publisher"];

$book_id = $_REQUEST["book_id"];
$reservation_chk = $_REQUEST["reservation_chk"];

$new_isbn = $_REQUEST["new_isbn"];
$new_book_id = $_REQUEST["new_book_id"];


$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "";

if($name != null)
    $sql .= "UPDATE Book_Information SET name = '{$name}' WHERE (ISBN = {$isbn}); ";
if($author != null)
    $sql .= "UPDATE Book_Information SET author = '{$author}' WHERE (ISBN = {$isbn}); ";
if($publisher != null)
    $sql .= "UPDATE Book_Information SET publisher = '{$publisher}' WHERE (ISBN = {$isbn}); ";

if($reservation_chk != null)
    $sql .= "UPDATE Book_Statement SET reservation_chk = '{$reservation_chk}' WHERE (book_id = {$book_id}); ";

if($new_isbn != null)
    $sql .= "UPDATE Book_Information SET ISBN = '{$new_isbn}' WHERE (ISBN = {$isbn}); ";
if($new_book_id != null)
    $sql .= "UPDATE Book_Statement SET book_id = '{$new_book_id}' WHERE (book_id = {$book_id}); ";


$result = mysqli_query($conn, $sql);
echo 1;