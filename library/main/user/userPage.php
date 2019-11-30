<?php
	#delete from LB_DB.User_Account where id = . $_SESSION['id'] ."\";";
	$db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
#	if( mysqli_num_rows($db_result) == 0 )
#		
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Main User Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userCSS.css">
</head>
<body>

<div>
    <h1 align="center">User Main Page</h1>
    <?php
    session_start();
    $_SESSION['id'] = $_REQUEST['id'];
    echo "<p align='right'>id : {$_SESSION['id']} <input type='button' value='정보수정' onclick='clickModal'()> </p>";
    ?>
</div>
<div class = "sidebar" style="width:13%">
    <input type="button" class = "bar-item" value ="대출목록" id ="borrow" onclick="OnChange()">
    <input type="button" class = "bar-item" value ="도서검색"id = "search" onclick="OnChange()">
    <input type="button" class = "bar-item" value ="예약현황"id = "reserve" onclick="OnChange()">
</div>

<div id="borrowList" style="margin-left:15%">
    <table>
        <caption align="center"> 대출 목록 </caption>
        <tr>
            <td width="10%">책 번호 </td><td width="30%">책 이름</td> <td width="25%">예약일</td> <td width="25%"> 반납일 </td> <td width="10%"> 반납 </td>
        </tr>
	    <?php
	#	$db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
		$db_sql = "SELECT * FROM Borrow_Information WHERE id = \"". $_SESSION['id'] ."\";";
		$db_result = mysqli_query( $db_conn, $db_sql );

		while( $db_row = mysqli_fetch_array( $db_result) ){
			$book_sql = "SELECT * FROM Book_Information where ISBN = (select ISBN from Book_Statement where book_id = ". $db_row['book_id'] .");" ;
			$book_result = mysqli_query( $db_conn, $book_sql);
			$book_row = mysqli_fetch_array( $book_result);
			echo "<tr> <td>".$db_row['book_id'] ."</td> <td>". $book_row[ 'name'] ."</td><td>".$db_row['start_date']."</td><td>".$db_row['end_date']."</td><td>반납</td>"; #반납시 onclick으로 호출하는부분
		}
	    ?>
		<?php
			$db_sql = "delete from Borrow_information where book_id = ". 2 ."order by reservation_date asc limit 1;";
			#$db_result = mysqli_query( $db_conn, $db_sql);	
			$db_sql = "select id from Reservation_Information where book_id = ". 2 ." order by reservation_date asc limit 1;"; #book_id 가져오기
			$db_result = mysqli_query( $db_conn, $db_sql );
			if(  mysqli_num_rows($db_result) != 0 ){
				$reservation_id = mysqli_fetch_array($db_result)[0];
			 	$db_sql = "delete from Reservation_information where book_id = ". 2 ."order by reservation_date asc limit 1;";
				#$db_result = mysqli_query( $db_conn, $db_sql); 	
				#$db_sql = "insert into Borrow_Information ( id, book_id, start_date, end_date ) VALUES(\"". $reservation_id ."\" ,\"". 2 . "\" ,from_unixtime(unix_timestamp()), from_unixtime(unix_timestamp() + 864000 ))" ;
	
			}
		?>

    </table>
</div>

<div id ="reserveBook" style="margin-left: 15%">
    <table>
        <caption align="center"> 예약 현황 </caption>
        <tr>
            <td width="50%"> 책 제목 </td> <td width="15%"> 대기 인원</td>
            <td width="25%"> 대출 가능일 </td> <td width="10%">예약 취소</td>
        </tr>
    </table>
</div>

<div id ="searchBook" style="margin-left: 15%">
    <form>
        <p>ISBN: <input type="text"> </p>
        <p>도서이름: <input type="text"> </p>
        <p> <input type="button" value="검색"></p>
    </form>
    <table>
        <caption align="center"> 검색 결과 </caption>
        <tr>
            <td width="30%">ISBN </td> <td width="30%"> 책 제목 </td>
            <td width="15%"> 작가</td> <td width="10%"> 출판사</td>
            <td width="10%"> 대출 여부</td> <td width="5%">예약</td>
        </tr>
    </table>
</div>


<div id="infoModal" class="modal">
    <form id='infoContent' class="modal-content" method="get">
        <p>ID <input type="text" id="idSignUpBox" name="idSignUpBox" placeholder="input id" required></p>
        <p>Password <input type="text" id="pwSignUpBox" name="pwSignUpBox" placeholder="input password" required></p>
        <p>Name <input type="text" id="nameSignUpBox" name="nameSignUpBox" placeholder="input name" required></p>
        <p>E-Mail <input type="email" id="emailSignUpBox" name="emailSignUpBox" placeholder="input e-mail" required></p>
        <p>Phone Number <input type="text" id="phoneSignUpBox" placeholder="000-0000-0000" name="phoneSignUpBox" required></p>
        <p>Classification
            <input type="text" id="classificationSignUpBox" name="classificationSignUpBox" placeholder="choice" list="choices" required>
            <datalist id="choices">
                <option value="학부"></option>
                <option value="대학원"></option>
                <option value="교직원"></option>
            </datalist></p>
        <input type="button" value="Done">
        <input type="button" value="Cancel" onclick="closeModal()">
    </form>
</div>

<script src="userJS.js"></script>
</body>
</html>
