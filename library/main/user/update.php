<?php
    function insertUser($conn, $uid, $pwd, $name, $email, $pnum, $proper){
        $sql = "INSERT INTO User (ID, Passwd, Name, Email, PhoneNumber, Properity)
                    VALUES ($uid, $pwd, $name, $email, $pnum, $proper)";
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Insert User Success.\n";
        }
    }
    function insertLent($conn, $uid, $isbn, $lentDate, $retDate, $countNum){
        $sql = "INSERT INTO Lent (UserID, ISBN, LentDate, ReturnDate, CountNumber)
                    VALUES ($uid, $isbn, $lentDate, $retDate, $countNum)";
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Insert Lent Success.\n";
        }
    }
    function insertBook($conn, $isbn, $uname, $resInfo, $lentInfo, $author, $publisher, $countNum){
        $sql = "INSERT INTO Book (ISBN, Name, Reservation_Info, Lent_Info, Author, Publisher, CountNumber)
                    VALUES ($isbn, $uname, $resInfo, $lentInfo, $author, $publisher, $countNum)";
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Insert Book Success.\n";
        }
    }
    function insertReservation($conn, $uid, $rdate, $isbn){
        $sql = "INSERT INTO Reservation (UserID, Date, ISBN)
                    VALUES ($uid, $rdate, $isbn)";
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Insert Lent Success.\n";
        }
    }
    function updateUser($conn, $uid, $pwd, $name, $email, $pnum, $proper, $condition){
        if ($condition != null){
            $sql = "UPDATE User SET Passwd = $pwd  WHERE $condition"; // 비밀번호
            $sql = "UPDATE User SET Email = $email WHERE $condition"; // 이메일
            $sql = "UPDATE User SET PhoneNumber = $pnum WHERE $condition"; // 휴대폰번호
            $sql = "UPDATE User SET Properity = $proper WHERE $condition"; // 구분
        }else{
            $sql = "UPDATE User SET Passwd = $pwd"; // 비밀번호
            $sql = "UPDATE User SET Email = $email"; // 이메일
            $sql = "UPDATE User SET PhoneNumber = $pnum"; // 휴대폰번호
            $sql = "UPDATE User SET Properity = $proper"; // 구분
        }
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Update User Success.\n";
        }
    }
    function updateBook($conn, $isbn, $uname, $resInfo, $lentInfo, $author, $publisher, $countNum, $condition){
        if ($condition != null){
            $sql = "UPDATE Book SET ISBN = $isbn WHERE $condition"; // ISBN
            $sql = "UPDATE Book SET Name = $uname WHERE $condition"; // 책이름
            $sql = "UPDATE Book SET Reservation_Info = $resInfo WHERE $condition"; // 예약정보
            $sql = "UPDATE Book SET Lent_Info = $lentInfo WHERE $condition"; //대출 정보
            $sql = "UPDATE Book SET Author = $author WHERE $condition"; // 저자
            $sql = "UPDATE Book SET Publisher = $publisher WHERE $condition"; // 출판사
            $sql = "UPDATE Book SET CountNumber = $countNum WHERE $condition"; // 책 권수
        }else{
            $sql = "UPDATE Book SET ISBN = $isbn"; // ISBN
            $sql = "UPDATE Book SET Name = $uname"; // 책이름
            $sql = "UPDATE Book SET Reservation_Info = $resInfo"; // 예약정보
            $sql = "UPDATE Book SET Lent_Info = $lentInfo"; // 대출 정보
            $sql = "UPDATE Book SET Author = $author"; // 저자
            $sql = "UPDATE Book SET Publisher = $publisher"; // 출판사
            $sql = "UPDATE Book SET Publisher = $countNum"; // 책 권수
        }
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Update Book Success.\n";
        }
    }
    function updateLent($conn, $uid, $isbn, $lentDate, $retDate, $countNum, $condition){
        if ($condition != null){
             $sql = "UPDATE Lent SET UserID = $uid WHERE $condition"; // 회원
             $sql = "UPDATE Lent SET ISBN = $isbn WHERE $condition"; // ISBN
             $sql = "UPDATE Lent SET LentDate = $lentDate WHERE $condition"; // 대출 기간
             $sql = "UPDATE Lent SET ReturnDate = $retDate WHERE $condition"; // 반납 날짜
             $sql = "UPDATE Lent SET CountNumber = $countNum WHERE $condition"; // 책 권수
        }else{
             $sql = "UPDATE Lent SET UserID = $uid"; // 회원
             $sql = "UPDATE Lent SET ISBN = $isbn"; // ISBN
             $sql = "UPDATE Lent SET LentDate = $lentDate"; // 대출 기간
             $sql = "UPDATE Lent SET ReturnDate = $retDate"; // 반납 날짜
             $sql = "UPDATE Lent SET CountNumber = $countNum"; // 책 권수
        }
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Update Lent Success.\n";
        }
    }
    function updateReservation($conn, $uid, $rdate, $isbn, $condition){
        if ($condition != null){
            $sql = "UPDATE Reservation SET UserID = $uid WHERE $condition"; // 회원
            $sql = "UPDATE Reservation SET Date = $rdate WHERE $condition"; // 예약 날짜
            $sql = "UPDATE Reservation SET ISBN = $isbn WHERE $condition"; // iSBN
        }else{
            $sql = "UPDATE Reservation SET UserID = $uid"; // 회원
            $sql = "UPDATE Reservation SET Date = $rdate"; // 예약 날짜
            $sql = "UPDATE Reservation SET ISBN = $isbn"; // iSBN
        }
        if(mysqli_query($conn, $sql) === false){    //result print
            echo mysqli_error($conn);
        }else{
            echo "Update Reservation Success.\n";
        }
    }
    function connectDB($ipAddr,$user, $pwd, $dbName, $dbPort){
        $conn = mysqli_connect("127.0.0.1", "root", "1q2w3e4r", "libraryDB", 3306);
        //connection Test
        if($conn){ echo "MySQL 접속 성공\n"; }
        else { echo "MySQL 접속 실패\n"; }
        return $conn;
    }
    function selectDB($conn, $tableName, $selectList, $condition){
        if ($condition != null){
            $sql = "SELECT $selectList from $tableName WHERE $condition";
        }
        else {
            $sql = "SELECT $selectList from $tableName";
        }
        echo mysqli_query($conn, $sql);
    }
    function inputData(){   //this method is fetch input data on web page
    }
    function search(){  //user select method and parsing return data
    }
    $conn = connectDB("127.0.0.1", "root", "1q2w3e4r", "libraryDB", 3306);
    $inputs = inputData();  //parsing inputs and excute method according to situation
    insertUser($conn, "201500000", "1q2w3e4r", "Tester", "edgecoding@naver.com", "12345678", "Student");
    mysqli_close($conn);
?>
