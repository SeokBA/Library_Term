<?php
$id = $_REQUEST["id"];
$newId = $_REQUEST["newId"];
$pw = $_REQUEST["pw"];
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$classification = $_REQUEST["classification"];


$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$sql = "UPDATE User_Account SET ";

if($newId != null)
    $sql .= "id = '{$newId}' ";
if($pw != null) {
    if($sql != "UPDATE User_Account SET ")
        $sql .= ", ";
    $sql .= "password = '{$pw}' ";
}
if($name != null) {
    if ($sql != "UPDATE User_Account SET ")
        $sql .= ", ";
    $sql .= "name = '{$name}' ";
}
if($email != null) {
    if ($sql != "UPDATE User_Account SET ")
        $sql .= ", ";
    $sql .= "email = '{$email}' ";
}
if($phone != null) {
    if ($sql != "UPDATE User_Account SET ")
        $sql .= ", ";
    $sql .= "phone = '{$phone}' ";
}
if($classification != null) {
    if ($sql != "UPDATE User_Account SET ")
        $sql .= ", ";
    $sql .= "classification = '{$classification}' ";
}

$sql .= "WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql);
echo 1;