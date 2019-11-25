<?php
$_SESSION['user'] = $_GET["id"];
Header("Location: /library/main/todoList.html");