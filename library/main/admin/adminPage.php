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
    ?>
</div>
<div class="sideBar" style="width:13%">
    <input type="button" class="barItem" value="도서목록" id="bookListSideBar" onclick="changeTable()">
    <input type="button" class="barItem" value="도서반납" id="returnBookSideBar" onclick="changeTable()">
    <input type="button" class="barItem" value="회원관리" id="userManageSideBar" onclick="changeTable()">
</div>
<div id="bookListTable" style="margin-left:15%">
    <input type="button" value="등록" onclick="clickAddBook()">
    <table>
        <caption align="center">도서 목록</caption>
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
        $sql = "SELECT * FROM Book_Statement";
        $result = mysqli_query($_SESSION['conn'], $sql);
        while (($bookStateRow = mysqli_fetch_array($result)) != null) {
            $sql = "SELECT * FROM Book_Information WHERE ISBN = {$bookStateRow['ISBN']};";
            $bookInformation = mysqli_query($_SESSION['conn'], $sql);
            $bookInformation = mysqli_fetch_array($bookInformation);
            echo "<tr>
                    <td>{$bookInformation['name']}</td>
                    <td>{$bookInformation['ISBN']}</td>
                    <td>{$bookInformation['author']}</td>
                    <td>{$bookInformation['publisher']}</td>
                    <td class='button-td'><input type='button' value='수정' onclick='clickModifyBook(\"" . $bookInformation['ISBN'] . "\")'></td>";

            $sql = "SELECT * FROM Borrow_Information WHERE book_id = {$bookStateRow['book_id']};";
            $borrowInformation = mysqli_query($_SESSION['conn'], $sql);
            if ($borrowInformation->num_rows == 0) {
                echo "<td class='button-td'><input type='button' value='삭제' onclick='removeBook(\"" . $bookStateRow['book_id'] . "\")'></td>";
            }
            else {
                echo "<td class='button-td'>대출중</td>";
            }
            echo "</tr>";

        }
        ?>
        </tbody>
    </table>
</div>

<div id="returnBookTable" style="margin-left:15%">
    <table>
        <caption align="center">도서 반납</caption>
        <thead>
        <tr>
            <td width="35%">책 이름</td>
            <td width="25%">예약자 id</td>
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
            if(isset($borrowRow) ){
                echo "<tr>
                    <td>{$bookRow['name']}</td>
                    <td>{$userRow['id']}</td>
                    <td>{$borrowRow['start_date']}</td>
                    <td>{$borrowRow['end_date']}</td>
                    <td class='button-td'><input type='button' value='반납' onclick='returnBook(\"".$bookStateRow['book_id']."\")'></td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div id="userManageTable" style="margin-left:15%">
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
                    <td class='button-td'><input type='button' value='수정' onclick='clickModifyUser(\"" . $userRow['id'] . "\")'></td>
                    <td></td>
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
                    <td class='button-td'><input type='button' value='수정' onclick='clickModifyUser(\"" . $userRow['id'] . "\")'></td>
                    <td class='button-td'><input type='button' value='탈퇴' onclick='withdraw(\"" . $userRow['id'] . "\")'></td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
    <input type="button" id="rankUser" value="대출 TOP 10 회원" onclick="clickRank()">
</div>

<div id="addBookModal" class="modal">
    <form id='addBookContent' class="modal-content" method="get">
        <p>제목<input type="text" id="addTitle"></p>
        <p>ISBN<input type="text" id="addISBN"></p>
        <p>저자<input type="text" id="addAuthor"></p>
        <p>출판사<input type="text" id="addPublisher"></p>
        <input type="button" value="Done" onclick="addBook()">
        <input type="button" value="Cancel" onclick="closeAddBook()">
    </form>
</div>

<div id="modifyBookModal" class="modal">
    <form id='modifyBookContent' class="modal-content" method="get">
        <p>제목<input type="text" id="modifyTitle"></p>
        <p>ISBN<input type="text" id="modifyISBN"></p>
        <p>저자<input type="text" id="modifyAuthor"></p>
        <p>출판사<input type="text" id="modifyPublisher"></p>
        <input type="button" value="Done" onclick="modifyBook()">
        <input type="button" value="Cancel" onclick="closeModifyBook()">
    </form>
</div>

<div id="borrowRankModal" class="modal">
    <div id="borrowRankContent" class="modal-content">
        <table>
            <caption class="modal-caption" align="center">대출 TOP 10</caption>
            <thead>
            <tr>
                <td>순위</td>
                <td>ID</td>
                <td>이름</td>
                <td>대출 수</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM User_Account ORDER BY total_borrow DESC";
            $result = mysqli_query($_SESSION['conn'], $sql);
            $size = 0;
            while (($userRow = mysqli_fetch_array($result)) != null && $size < 10) {
                if ($userRow['name'] != "admin") {
                    $size++;
                    echo "<tr>
                    <td>{$size}</td>
                    <td>{$userRow['id']}</td>
                    <td>{$userRow['name']}</td>
                    <td>{$userRow['total_borrow']}</td>
                </tr>";
                }
            }
            ?>
            </tbody>
        </table>
        <input type="button" value="Close" onclick="closeRank()">
    </div>
</div>

<div id="modifyUserModal" class="modal">
    <form id="modifyUserContent" class="modal-content" method="get">
        <h2>Modify Account</h2>
        <p>ID</p>
        <input type="text" id="modifyID" placeholder="input id">
        <br><br>
        <p>password</p>
        <input type="text" id="modifyPW" placeholder="input pw">
        <br><br>
        <p>Name</p>
        <input type="text" id="modifyName" placeholder="input name">
        <br><br>
        <p>E-Mail</p>
        <input type="email" id="modifyEmail" placeholder="input email">
        <br><br>
        <p>Phone Number</p>
        <input type="text" id="modifyPhone" placeholder="input phone num">
        <p>Classification</p>
        <input type="text" id="modifyClassification" placeholder="input Classification" list="choices">
        <datalist id="choices">
            <option value="학부"></option>
            <option value="대학원"></option>
            <option value="교직원"></option>
        </datalist>
        <br><br><br>
        <input type="button" value="submit" onclick="modifyAccount()">
        <input type="button" value="Cancel" onclick="closeModifyUser()">
    </form>
</div>
<script src="adminJS.js?ver=2"></script>
</body>
</html>
