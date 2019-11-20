<?php
$id = $_POST["idTextBox"];
$pw = $_POST["pwTextBox"];
$file = fopen("data/person.txt", "a+");

if($id == "" || $pw == "") {
    echo "아이디 또는 패스워드를 입력해주세요.";
} else{
    while(!feof($file)) {
        $dataString = fgets($file);
        $dataID = strtok($dataString, "|"); ;
        if ($id == $dataID){
            echo "이미 존재하는 아이디가 있습니다.";
            return;
        }
    }
    fwrite($file, "{$id}|{$pw}\n");
    fclose($file);
    echo "성공적으로 저장되었습니다.";
}