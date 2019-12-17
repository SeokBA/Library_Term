<?php
    $db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
    $id = $_REQUEST['id'];
    $book_id = $_REQUEST['bookid'];
	
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
	$db_sql = "insert into Borrow_Information ( id, book_id, start_date, end_date)";
	$db_sql = $db_sql."value ( \"{$id}\" , {$book_id} , from_unixtime(unix_timestamp()), from_unixtime(unix_timestamp() + {$borrow_date} ));";
	$db_result = mysqli_query( $db_conn, $db_sql );
	$db_sql = "update Book_Statement set reservation_chk = 0 where book_id = {$book_id};";
	$db_result = mysqli_query( $db_conn, $db_sql );
	echo $db_sql;
	echo "1";

?>
