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

</div>

<div id="borrowList" style="margin-left:15%">
    <table>
        <caption align="center"> 대출 목록 </caption>
        <tr>
            <td width="40%">책 이름</td> <td width="25%">예약일</td> <td width="25%"> 반납일 </td> <td width="10%"> 반납 </td>
        </tr>
    </table>
</div>

<script src="adminJS.js"></script>
</body>
</html>