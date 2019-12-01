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
    $_SESSION['conn'] = mysqli_connect('112.166.141.161', 'root', 'kylin1q2w3e4r', 'LB_DB');
    echo "<p align='right'>id : " . $_SESSION['id'] . " <input type='button' value='정보수정' onclick='clickModal()'></p>";
    ?>
</div>
<div class="sidebar" style="width:13%">
    <input type="button" class="bar-item" value="도서목록" id="booklist" onclick="OnChange()">
    <input type="button" class="bar-item" value="도서반납" id="returnbook" onclick="OnChange()">
    <input type="button" class="bar-item" value="회원관리" id="manage" onclick="OnChange()">
</div>
<div id="bookList" style="margin-left:15%">
    <input type="button" value="등록" onclick="clickRegister()">
    <table>
        <caption align="center"> 도서 목록</caption>
        <thead>
        <tr>
            <td width="40%">책 이름</td>
            <td width="25%">ISBN</td>
            <td width="15%">저자</td>
            <td width="10%">출판사</td>
            <td width="5%">수정</td>
            <td width="5%">삭제</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT ISBN, book_id FROM Book_Statement WHERE reservation_chk = 0;";
        $result = mysqli_query($_SESSION['conn'], $sql);
        $rowNum = $result->num_rows;
        while (($bookStateRow = mysqli_fetch_array($result)) != null) {
            if ($bookStateRow['reservation_id'] == 0) {
                $sql = "SELECT * FROM Book_Information WHERE ISBN = {$bookStateRow['ISBN']};";
                $bookInformation = mysqli_query($_SESSION['conn'], $sql);
                $bookInformation = mysqli_fetch_array($bookInformation);
                echo "<tr>
                    <td>{$bookInformation['name']}</td>
                    <td>{$bookInformation['ISBN']}</td>
                    <td>{$bookInformation['author']}</td>
                    <td>{$bookInformation['publisher']}</td>
                    <td class='button-td'><input type='button' value='수정'></td>
                    <td class='button - td'><input type='button' value='삭제' onclick='bookRemove(" . $bookStateRow['book_id'] . ")'></td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div id="returnBook" style="margin-left:15%">
    <table>
        <caption align="center"> 도서 반납</caption>
        <thead>
        <tr>
            <td width="40%">책 이름</td>
            <td width="25%">예약자</td>
            <td width="15%"> 대출일</td>
            <td width="15%"> 반납일</td>
            <td width="5% "> 반납</td>
        </tr>
        </thead>
        <tbody>
        <?php

        ?>
        </tbody>
    </table>
</div>

<div id="userManage" style="margin-left:15%">
    <table>
        <caption align="center"> 회원관리</caption>
        <thead>
        <tr>
            <td width="40%"> 이름</td>
            <td width="25%"> 대출 수</td>
            <td width="25%"> 시작일</td>
            <td width="10%"> 종료일</td>
            <td width="5%">수정</td>
            <td width="5%">삭제</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT ISBN, book_id FROM Book_Statement WHERE reservation_chk = 0;";
        $result = mysqli_query($_SESSION['conn'], $sql);
        $rowNum = $result->num_rows;
        while (($bookStateRow = mysqli_fetch_array($result)) != null) {
            if ($bookStateRow['reservation_id'] == 0) {
                $sql = "SELECT * FROM Book_Information WHERE ISBN = {$bookStateRow['ISBN']};";
                $bookInformation = mysqli_query($_SESSION['conn'], $sql);
                $bookInformation = mysqli_fetch_array($bookInformation);
                echo "<tr>
                    <td>{$bookInformation['name']}</td>
                    <td>{$bookInformation['ISBN']}</td>
                    <td>{$bookInformation['author']}</td>
                    <td>{$bookInformation['publisher']}</td>
                    <td class='button-td'><input type='button' value='수정'></td>
                    <td class='button - td'><input type='button' value='삭제' onclick='bookRemove(" . $bookStateRow['book_id'] . ")'></td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div id="registerModal" class="modal">
    <form id='registerContent' class="modal-content" method="get">
        <p> 제목 <input type="text" id="title"></p>
        <p> ISBN <input type="text" id="ISBN"></p>
        <p> 저자 <input type="text" id="author"></p>
        <p> 출판사 <input type="text" id="publisher"></p>
        <input type="button" value="Done" onclick="clickRegister()">
        <input type="button" value="Cancel" onclick="closeRegister()">
    </form>
</div>

<div id="modifyModal" class="modal">
    <form id='infoContent' class="modal-content" method="get">
        <p> 제목 <input type="text" id="title"></p>
        <p> ISBN <input type="text" id="ISBN"></p>
        <p> 저자 <input type="text" id="author"></p>
        <p> 출판사 <input type="text" id="publisher"></p>
        <input type="button" value="Done" onclick="clickModify()">
        <input type="button" value="Cancel" onclick="closeModify()">
    </form>
</div>
<script src="adminJS.js"></script>
</body>
</html>