<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ToDo List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="todoStyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <input type="button" value="추가" onclick="addPopup()">
    <input type="button" value="검색" onclick="searchPopup()">
    <br>
    <br>
    <table>
        <tr>
            <th class="red">가족</th><th class="blue">학교</th>
        </tr>
        <tr>
            <td id="family" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php
                $filename="data/{$_SESSION['user']}_family.txt";
                if(file_exists($filename)) {
                    $file = fopen($filename, "r") or die();
                    while (!feof($file)) {
                        $dataString = fgets($file);
                        if($dataString == "")
                            break;
                        $memo = strtok($dataString, "|");
                        $start = strtok("|");
                        $end = strtok("|");
                        echo "<li id='{$dataString}' draggable='true' ondragstart='drag(event)'>{$memo} ({$start} ~ {$end} )<i name='{$dataString}' class='fa fa-close' onclick=\"delList(event)\"></i></li>";
                    }
                }
                ?>
            </td>
            <td id="school" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php
                $filename="data/{$_SESSION['user']}_school.txt";
                if(file_exists($filename)) {
                    $file = fopen($filename, "r") or die();
                    while (!feof($file)) {
                        $dataString = fgets($file);
                        if($dataString == "")
                            break;
                        $memo = strtok($dataString, "|");
                        $start = strtok("|");
                        $end = strtok("|");
                        echo "<li id='{$dataString}' draggable='true' ondragstart='drag(event)'>{$memo} ({$start} ~ {$end} )<i name='{$dataString}' class='fa fa-close' onclick=\"delList(event)\"></i></li>";
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <th class="red">여행</th><th class="blue">운동</th>
        </tr>
        <tr>
            <td id="trip" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php
                $filename="data/{$_SESSION['user']}_trip.txt";
                if(file_exists($filename)) {
                    $file = fopen($filename, "r") or die();
                    while (!feof($file)) {
                        $dataString = fgets($file);
                        if($dataString == "")
                            break;
                        $memo = strtok($dataString, "|");
                        $start = strtok("|");
                        $end = strtok("|");
                        echo "<li id='{$dataString}' draggable='true' ondragstart='drag(event)'>{$memo} ({$start} ~ {$end} )<i name='{$dataString}' class='fa fa-close' onclick=\"delList(event)\"></i></li>";
                    }
                }
                ?>
            </td>
            <td id="exercise" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php
                $filename="data/{$_SESSION['user']}_exercise.txt";
                if(file_exists($filename)) {
                    $file = fopen($filename, "r") or die();
                    while (!feof($file)) {
                        $dataString = fgets($file);
                        if($dataString == "")
                            break;
                        $memo = strtok($dataString, "|");
                        $start = strtok("|");
                        $end = strtok("|");
                        echo "<li id='{$dataString}' draggable='true' ondragstart='drag(event)'>{$memo} ({$start} ~ {$end} )<i name='{$dataString}' class='fa fa-close' onclick=\"delList(event)\"></i></li>";
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
           <td colspan="2" id="listResult"></td>
        </tr>
    </table>

    <div id='addModal' class="modal">
        <div class="modal-content">
            <form method="post">
                <p>할 일 분류 : <select id="addClass" name="addClass">
                        <option value="family">가족</option>
                        <option value="school">학교</option>
                        <option value="trip">여행</option>
                        <option value="exercise">운동</option>
                    </select></p>
                <p>메모 : <input type="text" id="addMemo" name="addMemo" required></p>
                <p>시작 날짜 : <input type="date" id="addStart" name="addStart" required></p>
                <p>끝나는 날짜 : <input type="date" id="addEnd" name="addEnd" required></p>
                <input type="submit" value="Submit" formaction="http://168.188.7.90/add_list.php">
                <input type="button" value="Close" onclick="closeAddPopup()">
            </form>
        </div>
    </div>

    <div id='searchModal' class="modal">
        <div class="modal-content">
            <form method="post">
                <p>메모 키워드 : <input type="text" id="searchMemo" name="searchMemo""></p>
                <p>시작 날짜 : <input type="date" id="searchStart" name="searchStart"></p>
                <p>끝나는 날짜 : <input type="date" id="searchEnd" name="searchEnd"></p>
                <p>정렬 기준 : <select id="searchBy" name="searchBy">
                        <option value="startTime">시작 날짜</option>
                        <option value="endTime">끝나는 날짜</option>
                        <option value="memo">메모</option>
                    </select></p>
                <input type="checkbox" value="descending" id="searchDes" name="searchDes" onchange="chgCheckBox(event)">내림차순
                <input type="checkbox" value="ascending" id="searchAsc" name="searchAsc" onchange="chgCheckBox(event)">오름차순
                <input type="button" value="Submit" onclick="search()">
            </form>
        </div>
    </div>

    <script src="todoJS.js"></script>
</body>
</html>