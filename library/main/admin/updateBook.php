<?php
$isbn = $_REQUEST["isbn"];
$name = $_REQUEST["name"];
$author = $_REQUEST["author"];
$publisher = $_REQUEST["publisher"];
$new_isbn = $_REQUEST["new_isbn"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "UPDATE Book_Information SET ";

if($new_isbn != null)
    $sql .= "ISBN = '{$new_isbn} '";
if($name != null) {
    if($sql != "UPDATE Book_Information SET ")
        $sql .= ", ";
    $sql .= "name = '{$name} '";
}
if($author != null) {
    if($sql != "UPDATE Book_Information SET ")
        $sql .= ", ";
    $sql .= "author = '{$author} '";
}if($publisher != null) {
    if($sql != "UPDATE Book_Information SET ")
        $sql .= ", ";
    $sql .= "publisher = '{$publisher} '";
}
$sql .= "WHERE ISBN = '{$isbn}'";
$result = mysqli_query($conn, $sql);
echo 1;