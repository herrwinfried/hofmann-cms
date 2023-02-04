<?php

require("../connection.php");
session_destroy();
session_unset();
unset($_SESSION['account']);
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['logged_in']);
header("Location:index.php");
?>