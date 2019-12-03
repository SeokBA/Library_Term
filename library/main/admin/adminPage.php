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
    echo "<p align='right'>id : " . $_SESSION['id'] . " <input type='button' value='정보수정' onclick=''></p>";
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
        <caption align="center">도서 목록</caption>
        <thead>
        <tr>
            <td width="30%">책 이름</td>
            <td width="25%">ISBN</td>
            <td width="15%">저자</td>
            <td width="10%">출판사</td>
            <td width="10%">등록 ID</td>
            <td width="5%">수정</td>
            <td width="5%">삭제</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT ISBN, book_id FROM Book_Statement WHERE reservation_chk = 0;";
        $result = mysqli_query($_SESSION['conn'], $sql);
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
                    <td class='button-td'><input type='button' value='수정' onclick='clickBook()'></td>
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
            <td width="25%">예약자(id)</td>
            <td width="15%">대출일</td>
            <td width="15%">반납일</td>
            <td width="5% ">반납</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM Book_Statement WHERE reservation_chk > 1;";
        $result = mysqli_query($_SESSION['conn'], $sql);
        while (($bookStateRow = mysqli_fetch_array($result)) != null) {
            $sql = "SELECT * FROM Borrow_Information WHERE book_id = {$bookStateRow['book_id']}";
            $borrowRow = mysqli_query($_SESSION['conn'], $sql);
            $borrowRow = mysqli_fetch_array($borrowRow);

            $sql = "SELECT * FROM Book_Information WHERE ISBN = {$bookStateRow['ISBN']};";
            $bookRow = mysqli_query($_SESSION['conn'], $sql);
            $bookRow = mysqli_fetch_array($bookRow);

            $sql = "SELECT * FROM User_Account WHERE id = '{$borrowRow['id']}';";
            $userRow = mysqli_query($_SESSION['conn'], $sql);
            $userRow = mysqli_fetch_array($userRow);
            echo "<tr>
                    <td>{$bookRow['name']}</td>
                    <td>{$userRow['id']}</td>
                    <td>{$borrowRow['start_date']}</td>
                    <td>{$borrowRow['end_date']}</td>
                    <td class='button-td'><input type='button' value='반납'></td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<div id="userManage" style="margin-left:15%">
    <table>
        <caption align="center">회원관리</caption>
        <thead>
        <tr>
            <th colspan="9" width="auto">Admin</th>
        </tr>
        <tr>
            <th width="15%">ID</th>
            <th width="10%">Password</th>
            <th width="15%">Name</th>
            <th width="20%">E-Mail</th>
            <th width="15%">Phone-Number</th>
            <th width="10%">Classification</th>
            <th width="5%">Total Borrow</th>
            <th width="5%">수정</th>
            <th width="5%">탈퇴</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM User_Account";
        $result = mysqli_query($_SESSION['conn'], $sql);
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
                    <td class='button-td'><input type='button' value='수정' onclick='clickUser()'></td>
                    <td class='button-td'><input type='button' value='탈퇴' onclick='clickWithdraw()' </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th colspan="9" width="auto">User</th>
        </tr>
        <tr>
            <th width="15%">ID</th>
            <th width="10%">Password</th>
            <th width="15%">Name</th>
            <th width="20%">E-Mail</th>
            <th width="15%">Phone-Number</th>
            <th width="10%">Classification</th>
            <th width="5%">Total Borrow</th>
            <th width="5%">수정</th>
            <th width="5%">탈퇴</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM User_Account";
        $result = mysqli_query($_SESSION['conn'], $sql);
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
                    <td class='button-td'><input type='button' value='수정' onclick='clickUser()'></td>
                    <td class='button-td'><input type='button' value='탈퇴' onclick='clickWithdraw()'></td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
    <input type="button" id="rankUser" value="대출 TOP 10 회원" onclick="clickRank()">
</div>

<div id="registerModal" class="modal">
    <form id='registerContent' class="modal-content" method="get">
        <h2 class="modalTitle"> 도서 정보 등록</h2>
        <p>제목<input type="text" id="title"></p>
        <p>ISBN<input type="text" id="ISBN"></p>
        <p>저자<input type="text" id="author"></p>
        <p>출판사<input type="text" id="publisher"></p>
        <p  class="modalButton" >
            <input type="button" value="Done" onclick="clickRegister()">
            <input type="button" value="Cancel" onclick="closeRegister()">
        </p>
    </form>
</div>

<div id="modifyBook" class="modal">
    <form id='bookContent' class="modal-content" method="get">
        <h2 class="modalTitle"> 도서 정보 수정</h2>
        <p>제목<input type="text" id="title"></p>
        <p>ISBN<input type="text" id="ISBN"></p>
        <p>저자<input type="text" id="author"></p>
        <p>출판사<input type="text" id="publisher"></p>
        <p class="modalButton"><input type="button" value="Done" onclick="clickBook()">
            <input type="button"  value="Cancel" onclick="closeBook()"></p>
    </form>
</div>

<div id="borrowRank" class="modal">
    <div id="rankContent" class="modal-content">
        <table>
            <caption class="modal-caption" align="center">대출 TOP 10</caption>
            <tr>
                <td>이름</td>
                <td>대출 수</td>
            </tr>
        </table>
        <input type="button" class="modalButton" value="Close" onclick="closeRank()">
    </div>
</div>


<div id="modifyUser" class="modal">
    <form id="modifyContent" class="modal-content" method="get">
        <h2 class="modalTitle"> 회원 정보 수정</h2>
        <p>ID<input type="text" id="userID"></p>
        <p>password<input type="password" id="modifyPassword" placeholder="modifyPw" required></p>
        <p>Name<input type="text" id="modifyName" placeholder="modifyId" required></p>
        <p>E-Mail<input type="email" id="modifyEmail" placeholder="modifyEmail"  required></p>
        <p>Phone Number<input type="text" id="modifyPhone" placeholder="000-0000-0000" pattern="(010)-\d{3,4}-\d{4}" required></p>
        <p>Classification
            <input type="text" id="classificationSignUpBox" name="modifyClassification" placeholder="choice" list="choices" required>
            <datalist id="choices">
                <option value="학부"></option>
                <option value="대학원"></option>
                <option value="교직원"></option>
            </datalist></p>
        <p class="modalButton">
            <input type="button" value="sumbit">
            <input type="button" class="modalButton" value="cancle" onclick="closeUser()">
        </p>
    </form>
</div>

<div id="withdrawUser" class="modal">
    <div id="withdrawContent" class="modal-content">
        <h2 class="modalTitle"> 회원 탈퇴</h2>
        <p class="modalText">탈퇴 하겠습니까?</p>
        <input type="button" value="OK" id="withdraw">
        <input type="button" value="Cancle" onclick="closeWithdraw()">
    </div>
</div>



<script src="adminJS.js"></script>
</body>
</html>