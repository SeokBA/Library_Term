<?php
session_start();
$id = $_POST["idTextBox"];
$pw = $_POST["pwTextBox"];

if($id == "" || $pw == "") {
    echo "아이디 또는 패스워드를 입력해주세요.";
} else{
    $file = fopen("data/person.txt", "a+");
    while(!feof($file)) {
        $dataString = fgets($file);
        $dataID = strtok($dataString, "|");
        if ($id == $dataID){
            $dataPW = strtok("|\n");
            if($pw == $dataPW){
                $_SESSION['user'] = $id;
                Header("Location: /todo_list.php");
            }
            else{
                echo "패스워드가 틀립니다.";
                return;
            }
        }
    }
    echo "존재하지 않는 아이디 입니다";
}