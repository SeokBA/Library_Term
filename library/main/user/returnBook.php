<?php

$book_id =  $_REQUEST["bookID"];

$db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');

$db_sql = "delete from Borrow_information where book_id = $book_id order by reservation_date asc limit 1;";
#$db_result = mysqli_query( $db_conn, $db_sql);
$db_sql = "select id from Reservation_Information where book_id = $book_id order by reservation_date asc limit 1;"; #book_id 가져오기
#$db_result = mysqli_query( $db_conn, $db_sql );
if(  mysqli_num_rows($db_result) != 0 ){
    $reservation_id = mysqli_fetch_array($db_result)[0];
    $db_sql = "delete from Reservation_information where book_id = $book_id order by reservation_date asc limit 1;";
    #$db_result = mysqli_query( $db_conn, $db_sql);
    #$db_sql = "insert into Borrow_Information ( id, book_id, start_date, end_date ) VALUES(\"". $reservation_id ."\" ,\"". 2 . "\" ,from_unixtime(unix_timestamp()), from_unixtime(unix_timestamp() + 864000 ))" ;
}
?>