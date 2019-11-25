<?php
session_start();
$data = $_REQUEST["data"];
$id = $_SESSION['user'];

if($data == "") {
    $class = $_POST["addClass"];
    $memo = $_POST["addMemo"];
    $start = $_POST["addStart"];
    $end = $_POST["addEnd"];
}
else{
    $class = strtok($data, "|");
    $memo = strtok("|");
    $start = strtok("|");
    $end = strtok("|");
}

$file = fopen("data/{$id}_{$class}.txt", "a+");
fwrite($file, "{$memo}|{$start}|{$end}\n");
fclose($file);
header('location:'.$_SERVER['HTTP_REFERER']);
