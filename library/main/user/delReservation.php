<?php



$id = $_REQUEST["id"];
$book_id= $_REQUEST["book_id"];

$conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');

$sql = "select * from Reservation_Information where book_id = {$book_id}";
$result = mysqli_query($conn, $sql);

if($result->num_rows == 1){
     $sql = "select * from Book_Statement where book_id = {$book_id}";
     $result = mysqli_query($conn, $sql);
     $result = mysqli_fetch_array($result);
     $reservation = $result['reservation_chk'] - 1;
     $sql = "UPDATE Book_Statement SET reservation_chk = {$reservation} WHERE book_id = {$book_id}";
     $result = mysqli_query($conn, $sql);
}
$sql = "delete from Reservation_Information where id = '{$id}' and book_id = {$book_id}";;
$result = mysqli_query($conn, $sql);
echo 1;
?>
