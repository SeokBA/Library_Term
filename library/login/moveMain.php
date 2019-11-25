<?php
$_SESSION['user'] = $_POST["id"];
Header("Location: /library/main/todoList.html");