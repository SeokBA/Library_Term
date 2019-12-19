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
    echo "<p id='userName' align='right'>id : {$_SESSION['id']}
    <input type='button' value='정보수정' onclick='clickInfo()'>
    <input type= 'button' value= '회원탈퇴' onclick='clickWithdraw()'>
    </p>";
    ?>
</div>
<div class = "sidebar" style="width:13%">
    <input type="button" class = "bar-item" value ="대출목록" id ="borrow" onclick="OnChange()">
    <input type="button" class = "bar-item" value ="도서검색"id = "search" onclick="OnChange()">
    <input type="button" class = "bar-item" value ="예약현황"id = "reserve" onclick="OnChange()">
</div>

<div id="borrowList" style="margin-left:15%">
    <table id ="borrowTable">
        <caption align="center"> 대출 목록 </caption>
        <thead>
        <tr>
            <td width="25%"> 책 번호 </td>
            <td width="35%"> 책 제목 </td>
            <td width="20%"> 대출일 </td>
            <td width="20%"> 반납예정일 </td>
            <td width="10%"> 반납 </td>
        </tr>
        </thead>
        <tbody>
        <?php
        #	$db_conn = mysqli_connect( '112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
        $db_sql = "SELECT * FROM Borrow_Information WHERE id = \"". $_SESSION['id'] ."\";";
        $db_result = mysqli_query( $db_conn, $db_sql );

        while( $db_row = mysqli_fetch_array( $db_result) ){
            $book_sql = "SELECT * FROM Book_Information where ISBN = (select ISBN from Book_Statement where book_id = ". $db_row['book_id'] ." and reservation_chk < 2 );";
            $book_result = mysqli_query( $db_conn, $book_sql);
            $book_row = mysqli_fetch_array( $book_result);
            if( isset($book_row) )
                echo "<tr> <td>".$db_row['book_id'] ."</td> <td>". $book_row[ 'name'] ."</td><td>".$db_row['start_date']."</td><td>".$db_row['end_date']."</td><td><input type='button' value='반납' onclick='returnRequest()'></td>"; #반납시 onclick으로 호출하는부분
        }

        ?>
        </tbody>
    </table>
</div>

<div id ="reserveBook" style="margin-left: 15%">
    <table>
        <caption align="center"> 예약 현황 </caption>
        <thead>
        <tr>
            <td width="25%"> ISBN </td>
            <td width="25%"> 책 제목 </td>
            <td width="15%"> 대기 인원 </td>
            <td width="25%"> 대출 가능일 </td>
            <td width="10%"> 예약 취소 </td>
        </tr>
        </thead>
        <tbody>
		<?php
        $db_sql = "SELECT * FROM Reservation_Information WHERE id = \"". $_SESSION['id'] ."\";";
        $db_result = mysqli_query( $db_conn, $db_sql );

        while( $db_row = mysqli_fetch_array( $db_result) ){
            $book_sql = "SELECT * FROM Book_Information where ISBN = (select ISBN from Book_Statement where book_id = ". $db_row['book_id'] ." and reservation_chk < 2 );";
            $book_result = mysqli_query( $db_conn, $book_sql);
            $book_row = mysqli_fetch_array( $book_result);
            if( isset($book_row) )
                echo "<tr> <td>".$db_row['book_id'] ."</td> <td>". $book_row[ 'name'] ."</td><td>".$db_row['start_date']."</td><td>".$db_row['end_date']."</td><td><input type='button' value='반납' onclick='returnRequest()'></td>"; #반납시 onclick으로 호출하는부분
        }
			$db_sql = "select * from Book_Information where ISBN = ( select ISBN FROM Book_Statement where book_id = (select book_id FROM LB_DB.Reservation_Information where id = '{$_SESSION['id']}'));";
		?>
	</tbody>

    </table>
</div>

<div id ="searchBook" style="margin-left: 15%">
    <form>
        <p>ISBN: <input type="text" id="ISBN" placeholder="input ISBN" required> </p>
        <p>도서이름: <input type="text" id="bookName" placeholder="input Book Name" required> </p>
        <p> <input type="button" id="search" value="검색" onclick="searchBook()"></p>


    </form>
    <table id='searchTable'>
        <caption align="center"> 검색 결과 </caption>
        <thead>
        <tr>
	    <td width="5%"> 책 번호</td>
            <td width="25"> ISBN </td>
            <td width="20%"> 책 제목 </td>
            <td width="15%"> 작가 </td>
            <td width="15%"> 출판사 </td>
            <td width="10%"> 대출 여부 </td>
            <td width="5%"> 대출 </td>
            <td width="5%"> 예약 </td>
        </tr>
        </thead>
        <tbody></tbody>

    </table>
</div>


<div id="infoModify" class="modal">
    <form id='modifyContent' class="modal-content" method="get">
        <h2> 본인 정보 수정 </h2>
        <p> ID </p>
        <input type="text" id="modifyId">
        <br><br>
        <p>Password</p>
        <input type="text" id="modifyPw" placeholder="input password" required>
        <br><br>
        <p>Name</p>
        <input type="text" id="modifyName" placeholder="input name" required>
        <br><br>
        <p>E-Mail </p>
        <input type="email" id="modifyEmail" placeholder="input e-mail" required>
        <br><br>
        <p>Phone Number</p>
        <input type="text" id="phoneModify" placeholder="input phone" required>
        <br><br>
        <p>Classification</p>
        <input type="text" id="modifyClassification" placeholder="input Classification" list="choices">
        <datalist id="choices">
            <option value="학부"></option>
            <option value="대학원"></option>
            <option value="교직원"></option>
        </datalist>
        <br><br><br>
        <input type="button" value="submit" onclick="modifyUserInfo()">
        <input type="button" value="cancel" onclick="closeInfo()">
    </form>
</div>

<div id="withdrawalModal" class="modal">
    <div id="withdraw" class="modal-content p">
        <h2>회원 탈퇴</h2>
        <p>탈퇴 하시겠습니까?</p>
        <input type="button" value="OK" id="withdraw" onclick="requestWithdraw()">
        <input type="button" value="Cancle" onclick="closeWithdraw()">
</div>
</div>

<div id="borrowModal" class="modal">
    <div class="modal-content">
        <h2>도서 대출</h2>
        <p>대출 하시겠습니까?</p>
        책 이름: <input type="text" id = "borrowBookName">
        <br>
        책 ID: <input type="text" id = "borrowBookId">
        <br>
        책 ISBN: <input type="text" id ="borrowBookISBN">
        <br>
        <p>
            <input type="button" value="OK" onclick="borrowBook()">
            <input type="button" value="Cancle" onclick="closeBorrow()">
        </p>

    </div>
</div>

<div id="reserveModal" class="modal">
    <div class="modal-content">
        <h2>도서 예약</h2>
        <p>예약 하시겠습니까?</p>
        책 이름: <input type="text" id = "reserveBookName">
        <br>
        책 ID: <input type="text" id = "reserveBookId">
        <br>
        책 ISBN: <input type="text" id ="reserveBookISBN">
        <br>
        <p><input type="button" value="OK" onclick="reserveBook()">
            <input type="button" value="Cancle" onclick="closeReserve()"></p>
    </div>
</div>

<div id="reserveCancelModal" class="modal">
    <div class="modal-content">
        <h2>도서 예약 취소</h2>
        <p>예약을 취소하시겠습니까?</p>
        책 이름: <input type="text" id = "cancelReserveName">
        <br>
        책 ISBN: <input type="text" id ="cancelReserveISBN">
        <br>
        <p><input type="button" value="OK" onclick="cancelReserve()">
            <input type="button" value="Cancle" onclick="closeCancelReserve()"></p>
    </div>
</div>

<script src="userJS.js?ver=1"></script>
</body>
</html>
