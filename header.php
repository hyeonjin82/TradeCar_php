<?php
session_start();

require("config/database.php");
if (empty($_SESSION['username'])) {
    header("Location: index.php");
    die("Redirecting to index.php");
}
$id = $_SESSION['username'][0];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_title; ?></title>
        <style>
            .left-margin{
                margin:0 .5em 0 0;
            }
            .right-button-margin{
                margin: 0 0 1em 0;
                overflow: hidden;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap_1.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap.min_1.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand">Jin's Car Trader</a>
                    <div class="nav-collapse ">
                        <ul class="nav pull-right">
                            <li><a href="loginproduct.php">Main</a></li>
                            <li class="divider-vertical"></li>
                            <li><a href="register.php">Register</a></li>
                            <li class="divider-vertical"></li>
                            <li><a href="mymenu.php?id=1"<?php echo $id;  ?>>My Menu</a></li>
                            <li class="divider-vertical"></li>
                            <li><a href="contactform.php">Contact Us</a></li>
                            <li class="divider-vertical"></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- container -->
        <?php
        echo "<h5> Welcome {$_SESSION['username'][1]} ~^^</h5>";
//        print_r($_SESSION['username']);
        ?>
        <div class="container">
            <?php
            // show page header
            echo "<div class='page-header'>";
            echo "<h1>{$page_title}</h1>";
            echo "</div>";
            ?>