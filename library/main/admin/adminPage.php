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
    echo "<p align='right'>id : " . $_SESSION['id'] . " <input type='button' value='정보수정' onclick='clickUser()'></p>";
    ?>
</div>
<div class="sideBar" style="width:13%">
    <input type="button" class="barItem" value="도서목록" id="bookListSideBar" onclick="OnChange()">
    <input type="button" class="barItem" value="도서반납" id="returnBookSideBar" onclick="OnChange()">
    <input type="button" class="barItem" value="회원관리" id="userManageSideBar" onclick="OnChange()">
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
                    <td class='button-td'><input type='button' value='삭제' onclick='bookRemove(" . $bookStateRow['book_id'] . ")'></td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div id="returnBook" style="margin-left:15%">
    <table>
        <caption align="center">도서 반납</caption>
        <thead>
        <tr>
            <td width="40%">책 이름</td>
            <td width="25%">예약자</td>
            <td width="15%">대출일</td>
            <td width="15%">반납일</td>
            <td width="5% ">반납</td>
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
        <caption align="center">회원관리</caption>
        <thead>
        <tr>
            <td colspan="9">Admin</td>
        </tr>
        <tr>
            <td width="15%">ID</td>
            <td width="10%">Password</td>
            <td width="15%">Name</td>
            <td width="20%">E-Mail</td>
            <td width="15%">Phone-Number</td>
            <td width="10%">Classification</td>
            <td width="5%">Total Borrow</td>
            <td width="5%">수정</td>
            <td width="5%">탈퇴</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM User_Account";
        $result = mysqli_query($_SESSION['conn'], $sql);
        $rowNum = $result->num_rows;
        while (($userRow = mysqli_fetch_array($result)) != null) {
            if ($userRow['name'] == "admin")
            echo "<tr>
                    <td>{$userRow['id']}</td>
                    <td>{$userRow['password']}</td>
                    <td>{$userRow['name']}</td>
                    <td>{$userRow['email']}</td>
                    <td>{$userRow['phone']}</td>
                    <td>{$userRow['classification']}</td>
                    <td>{$userRow['total_borrow']}</td>
                    <td class='button-td'><input type='button' value='수정'></td>
                    <td class='button-td'><input type='button' value='탈퇴'></td>
                </tr>";
        }
        ?>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <td colspan="9">User</td>
        </tr>
        <tr>
            <td width="15%">ID</td>
            <td width="10%">Password</td>
            <td width="15%">Name</td>
            <td width="20%">E-Mail</td>
            <td width="15%">Phone-Number</td>
            <td width="10%">Classification</td>
            <td width="5%">Total Borrow</td>
            <td width="5%">수정</td>
            <td width="5%">탈퇴</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM User_Account";
        $result = mysqli_query($_SESSION['conn'], $sql);
        $rowNum = $result->num_rows;
        while (($userRow = mysqli_fetch_array($result)) != null) {
            if ($userRow['name'] != "admin")
                echo "<tr>
                    <td>{$userRow['id']}</td>
                    <td>{$userRow['password']}</td>
                    <td>{$userRow['name']}</td>
                    <td>{$userRow['email']}</td>
                    <td>{$userRow['phone']}</td>
                    <td>{$userRow['classification']}</td>
                    <td>{$userRow['total_borrow']}</td>
                    <td class='button-td'><input type='button' value='수정'></td>
                    <td class='button-td'><input type='button' value='탈퇴'></td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
    <input type="button" id="rankUser" value="대출 TOP 10 회원" onclick="clickRank()">
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

<div id="modifyBook" class="modal">
    <form id='Book' class="modal-content" method="get">
        <p> 제목 <input type="text" id="title"></p>
        <p> ISBN <input type="text" id="ISBN"></p>
        <p> 저자 <input type="text" id="author"></p>
        <p> 출판사 <input type="text" id="publisher"></p>
        <input type="button" value="Done" onclick="clickBook()">
        <input type="button" value="Cancel" onclick="closeBook()">
    </form>
</div>

<div id="borrowRank" class="modal">
    <div id="Rank" class="modal-content">
        <table>
            <caption class="modal-caption" align="center"> 대출 TOP 10</caption>
            <tr>
                <td> 이름</td>
                <td> 대출 수</td>
            </tr>
        </table>
        <input type="button" value="Close" onclick="closeRank()">
    </div>
</div>


<div id="modifyUser" class="modal">
    <form id="User" class="modal-content" method="get">
        <p> ID <input type="text" id="userID"></p>
        <p> password <input type="text" id="modifypassword" placeholder="modify pw" required></p>
        <p> Name <input type="text" id="modifyName" placeholder="modify id" required></p>
        <p> E-Mail <input type="email" id="modifyEmail" placeholder="modify email" required></p>
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