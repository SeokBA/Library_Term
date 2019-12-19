<?php
   $db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB' );

   $id = $_REQUEST['id'];
   $book_id = $_REQUEST['bookid'];
      
   $dup_check = "select * from Reservation_Information where book_id = {$book_id} and id = \"{$id}\";";
   $dup_check_result = mysqli_query( $db_conn, $dup_check );
   $dup = mysqli_fetch_array( $dup_check_result );
   if( isset($dup) ){
        echo "dup";
        return ;
   }



   $res_sql = "select reservation_chk from Book_Statement where book_id = {$book_id};";
   $res_result = mysqli_query( $db_conn, $res_sql );
   $res_row = mysqli_fetch_array( $res_result );
   if( $res_row['reservation_chk'] % 2 == 0 ){   //예약이 없을 경우
        $borrow_sql = "select end_date from Borrow_Information where book_id = {$book_id};";
        $borrow_result = mysqli_query( $db_conn, $borrow_sql );
        $borrow_row = mysqli_fetch_array( $borrow_result );

        $insert_sql = "insert into Reservation_Information  ( id, book_id , reservation_date )";
        $insert_sql = $insert_sql . "value ( \"{$id}\" , {$book_id} , \"$end_date\" );";
        $insert_result = mysqli_query( $db_conn, $insert_sql );
        $update_sql = "update Book_Statement set reservation_chk = reservation_chk + 1 where book_id = {$book_id};";
        $update_result = mysqli_query( $db_conn, $update_sql );
   }
   else{    //예약이 있을 경우
        $borrow_sql = "select end_date from Borrow_Information where book_id = {$book_id};";
        $borrow_result = mysqli_query( $db_conn, $borrow_sql );
        $borrow_row = mysqli_fetch_array( $borrow_result );
        $end_date = $borrow_row['end_date'];
        $insert_sql = "insert into Reservation_Information  ( id, book_id , reservation_date )";
        $insert_sql = $insert_sql . "value ( \"{$id}\" , {$book_id} , \"$end_date\" );";
        $insert_result = mysqli_query( $db_conn, $insert_sql );
        echo $res_sql;
        echo $borrow_sql;
        echo $insert_sql;
   }

    

?>
