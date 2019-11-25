<?php
$_SESSION['user'] = $_POST["id"];
Header("Location: /todo_list.php");