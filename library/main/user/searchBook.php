<?php

	$db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
	$book_id = $_REQUEST['ISBN'];
	$book_name = $_REQUEST['bookname'];

	if($book_id != ""){
	        $db_sql = "SELECT * FROM LB_DB.Book_Information natural join LB_DB.Book_Statement where LB_DB.Book_Information.ISBN like \"%".$book_id."%\"";
		if($book_name != "")
			$db_sql = $db_sql."and LB_DB.Book_Information.name like \"%".$book_name."%\";";
		        $db_result = mysqli_query( $db_conn, $db_sql );	
                        echo "<caption aligh='center'> 검색 결과 </caption>";
				echo "<thead>";
				echo "<tr>";
					echo "<td width='5%'>" . '책 번호' . "</td>";
	                                echo "<td width='25%'>"  . 'ISBN'    .  "</td>";
        	                        echo "<td width='20%'>"  . '책 제목'   .  "</td>";
                	                echo "<td width='15%'>"  . '작가'    .  "</td>";
                        	        echo "<td width='15%'>"  . '출판사'   .  "</td>";
                                	echo "<td width= 10%'>"  . '대출 여부'   .  "</td>";
	                                echo "<td width= 5%'>"  . '대출'   .  "</td>";
        	                        echo "<td width= 5%'>"  . '예약'   .  "</td>";
                	        echo "</tr>";
				echo "</thead>";
			echo "<tbody>";
                while( $db_row =  mysqli_fetch_array ( $db_result ) ){
                        echo "<tr>";
				echo "<td>"  .  $db_row['book_id'] . "</td>";
                                echo "<td>"  .  $db_row['ISBN']  .  "</td>";
                                echo "<td>"  .  $db_row['name']  .  "</td>";
                                echo "<td>"  .  $db_row['author']  .  "</td>";
                                echo "<td>"  .  $db_row['publisher']  .  "</td>";
                                if( $db_row['reservation_chk'] >1 ){
                                        echo "<td>"  .  '대출중/예약가능'  .  "</td>";
                                        echo "<td>"  .  '대출'  .  "</td>";
                                        echo "<td onclick=\"temp()\">"  .  '예약'  .  "</td>";
                                }
                                else if( $db_row['reseration_chk'] == 1 ){
                                        echo "<td>"  .  '대출중/ 예약있음'  .  "</td>";
                                        echo "<td>"  .  '대출'  .  "</td>";
                                        echo "<td onclick=\"temp()\">"  .  '예약'  .  "</td>";
                                }
                                else{
                                        echo "<td>" . '대출가능', "</td>";
                                        echo "<td onclick=\"temp()\">"  .  '대출'  .  "</td>";
                                        echo "<td>"  .  '예약'  .  "</td>";
                                }
                        echo "</tr>";
                }
		echo "</tbody>";

	}
	else{
	        $db_sql = "SELECT * FROM LB_DB.Book_Information natural join LB_DB.Book_Statement where LB_DB.Book_Information.name like \"%".$book_name."%\";";
		
	        $db_result = mysqli_query( $db_conn, $db_sql );
		echo "<table id='searchTable'>";
			echo "<tr>";
				echo "<td width='5%'>"  .  '책 번호' . "</td>";
				echo "<td width='25%'>"  . 'ISBN'    .  "</td>";
				echo "<td width='20%'>"  . '책 제목'   .  "</td>";
				echo "<td width='15%'>"  . '작가'    .  "</td>";
				echo "<td width='15%'>"  . '출판사'   .  "</td>";
				echo "<td width= 10%'>"  . '대출 여부'   .  "</td>";
				echo "<td width= 5%'>"  . '대출'   .  "</td>";
				echo "<td width= 5%'>"  . '예약'   .  "</td>";
			echo "</tr>";
		while( $db_row =  mysqli_fetch_array ( $db_result ) ){
                        echo "<tr>";
				echo "<td>"  .  $db_row['book_id'] . "</td>";
                                echo "<td>"  .  $db_row['ISBN']  .  "</td>";
                                echo "<td>"  .  $db_row['name']  .  "</td>";
                                echo "<td>"  .  $db_row['author']  .  "</td>";
                                echo "<td>"  .  $db_row['publisher']  .  "</td>";
                                if( $db_row['reservation_chk'] >1 ){
                                        echo "<td>"  .  '대출중/예약가능'  .  "</td>";
                                	echo "<td>"  .  '대출'  .  "</td>";
                                	echo "<td onclick=\"temp()\">"  .  '예약'  .  "</td>";
				}
                                else if( $db_row['reseration_chk'] == 1 ){
                                        echo "<td>"  .  '대출중/ 예약있음'  .  "</td>";
	                                echo "<td>"  .  '대출'  .  "</td>";
	                                echo "<td onclick=\"temp()\">"  .  '예약'  .  "</td>";
				}
				else{
					echo "<td>" . '대출가능', "</td>";
        	                        echo "<td onclick=\"temp()\">"  .  '대출'  .  "</td>";
                                	echo "<td>"  .  '예약'  .  "</td>";
				}
                        echo "</tr>";
                }

		echo "</table>";

	}



?>
