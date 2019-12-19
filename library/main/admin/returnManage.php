<?php
$book_id = $_REQUEST["bookId"];
$db_conn = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
$db_sql = "delete from Borrow_Information where book_id = {$book_id};"; # 빌린 책 목록에서 지우기
$db_result = mysqli_query($db_conn, $db_sql);
$db_sql = "select id from Reservation_Information where book_id = {$book_id};"; #book_id 가져오기
$db_result = mysqli_query($db_conn, $db_sql);
if (mysqli_num_rows($db_result) == 3) {
    $reservation_id = mysqli_fetch_array($db_result)[0];
    $db_sql = "delete from Reservation_information where book_id = {$book_id} order by reservation_date asc limit 1;";
    $db_result = mysqli_query($db_conn, $db_sql);
    $db_sql = "select classification from User_Account where id = \"{$id}\";";
    $db_result = mysqli_query( $db_conn, $db_sql );
    $db_row =  mysqli_fetch_array ( $db_result );
    $borrow_date = '10';
    if( $db_row['classification'] == "교직원" )
        $borrow_date = '30';
    else if( $db_row['classification'] == "대학원" )
        $borrow_date = '20';
    else
        $borrow_date = '10';
    $borrow_date = $borrow_date * 86400;
    $db_sql = "insert into Borrow_Information ( id, book_id, start_date, end_date ) VALUES(\"". $reservation_id ."\" ,\"". 2 . "\" ,from_unixtime(unix_timestamp()), from_unixtime(unix_timestamp() + {$borrow_date} ))" ;
    $db_sql = "UPDATE Book_Statement SET reservation_chk = 1 WHERE (book_id = {$book_id}); ";
    $db_result = mysqli_query($db_conn, $db_sql);
}
else {
    $db_sql = "UPDATE Book_Statement SET reservation_chk = 4 WHERE (book_id = {$book_id}); ";
    $db_result = mysqli_query($db_conn, $db_sql);
}
echo 1;