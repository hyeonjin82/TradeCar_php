<?php
session_start();
session_unset();
session_destroy();
ob_start();
require("config/database.php");
unset($_SESSION['username']);
header("Location: index.php");
ob_end_flush();
die("Redirecting to: index.php");
?>