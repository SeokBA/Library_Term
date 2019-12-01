<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Main Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminCSS.css">
</head>
<body>

<div>
    <h1 align="center">Admin Main Page</h1>
    <?php
    session_start();
    $_SESSION['id'] = $_REQUEST['id'];
    echo "<p align='right'>id : {$_SESSION['id']} <input type='button' value='정보수정' onclick='clickModal'()> </p>";
    ?>
</div>
<div class = "sidebar" style="width:13%">
    <input type="button" class = "bar-item" value ="도서목록" id ="booklist" onclick="OnChange()">
    <input type="button" class = "bar-item" value ="도서반납" id = "returnbook" onclick="OnChange()">
    <input type="button" class = "bar-item" value ="회원관리" id = "manage" onclick="OnChange()">

</div>

<div id="bookList" style="margin-left:15%">
    <input type="button" value="등록" onclick="clickRegister()">
    <table>
        <caption align="center"> 도서 목록 </caption>
        <tr>
            <td width="40%">책 이름</td> <td width="25%">ISBN</td> <td width="15%"> 저자 </td> <td width="10%"> 출판사 </td><td
                    width ="5%"> 수정 </td> <td width="5%"> 삭제 </td>
        </tr>
    </table>
</div>

<div id="returnBook" style="margin-left:15%">
    <table>
        <caption align="center"> 도서 반납 </caption>
        <tr>
            <td width="40%">책 이름</td> <td width="25%">예약자</td> <td width="15%"> 대출일 </td> <td width="15%"> 반납일 </td>
            <td width="5%"> 반납 </td>
        </tr>
    </table>
</div>

<div id="Managepage" style="margin-left:15%">
<table>
    <caption align="center"> 회원관리 </caption>
    <tr>
        <td width="20%">이름</td> <td width="20%">ID</td> <td width="25%">현재 대출 수</td> <td width="15%">회원 종류</td>  <td width="10%">수정</td> <td width="10%">탈퇴</td>
    </tr>
</table>
<input type="button" id="rankUser" value="대출 TOP 10 회원 보기" onclick="clickRank()">
</div>

<div id="registerModal" class="modal">
    <form id='registerContent' class="modal-content" method="get">
        <p> 제목 <input type="text" id ="title" ></p>
        <p> ISBN <input type="text" id ="ISBN"></p>
        <p> 저자  <input type="text" id ="author"></p>
        <p> 출판사 <input type="text" id="publisher" ></p>
        <input type="button" value="Done" onclick="clickRegister()">
        <input type="button" value="Cancel" onclick="closeRegister()">
    </form>
</div>

<div id="modifyBook" class="modal">
    <form id='Book' class="modal-content" method="get">
        <p> 제목 <input type="text" id ="title" ></p>
        <p> ISBN <input type="text" id ="ISBN"></p>
        <p> 저자  <input type="text" id ="author"></p>
        <p> 출판사 <input type="text" id="publisher" ></p>
        <input type="button" value="Done" onclick="clickBook()">
        <input type="button" value="Cancel" onclick="closeBook()">
    </form>
</div>

<div id = "borrowRank" class="modal">
    <div id="Rank" class="modal-content">
        <table>
            <caption class = "modal-caption" align="center"> 대출 TOP 10 </caption>
            <tr>
                <td> 이름 </td><td> 대출 수</td>
            </tr>
        </table>
        <input type="button" value = "Close" onclick="closeRank()">
    </div>
</div>


<div id = "modifyUser" class="modal">
    <form id="User" class="modal-content" method="get">
        <p> ID <input type="text" id ="userID"></p>
        <p> password <input type="text" id="modifypassword" placeholder="modify pw" required></p>
        <p> Name <input type="text" id="modifyName" placeholder="modify id" required></p>
        <p> E-Mail <input type="email" id="modifyEmail" placeholder="modify email" required> </p>
        <p> Phone Number<input type="text" id="modifyPhone" placeholder="modify phone" required></p>
        <input type="button" value="sumbit">
        <input type="button" value="cancle" onclick="closeUser()">
    </form>
</div>

<div id="withdrawUser" class="modal">
    <div id="withdraw" class="modal-content">
        <p> 탈퇴 하겠습니까? </p>
        <input type="button" value="OK" id="withdraw">
        <input type="button" value="Cancle" onclick="closeWithdraw()">
    </div>
</div>


<script src="adminJS.js"></script>
</body>
</html>