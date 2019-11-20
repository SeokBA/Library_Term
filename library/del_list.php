<?php
session_start();
$data = $_REQUEST["data"];
$class = strtok($data, "|");
$string = strtok("\n");
$all = "";

$filename="data/{$_SESSION['user']}_{$class}.txt";
$file = fopen($filename, "r") or die();
while (!feof($file)) {
    $dataString = fgets($file);
    if($dataString == "")
        break;
    if ($dataString != "{$string}\n") {
        $all .= "{$dataString}";
    }
}
fclose($file);

$file = fopen($filename, "w") or die();
fwrite($file, $all);
fclose($file);