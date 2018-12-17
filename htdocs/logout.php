<?php
session_start();
require_once 'connect.php';
//echo "<H1>Welcome! ".$_SESSION["login_user"].".</H1>";
session_destroy();
header("location: login.php");
?>
