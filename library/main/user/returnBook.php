<?php

$book_id =  $_REQUEST["bookID"]; #반납 누르면 bookID 로가져와서
$db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$db_sql = "delete from Borrow_information where book_id = $book_id order by reservation_date asc limit 1;";
#대출목록에서 삭제
$db_result = mysqli_query( $db_conn, $db_sql);
$db_sql = "update Book_Statement set reservation_chk = reservation_chk + 2 where ( book_id = {$book_id} )";
$db_result = mysqli_query( $db_conn, $db_sql );
}?>
