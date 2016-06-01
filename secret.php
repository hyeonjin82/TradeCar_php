<?php
require("config/database.php");
if (empty($_SESSION['user'])) {
    header("Location: index.php");
    die("Redirecting to index.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap Tutorial</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap_1.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap.min_1.css" rel="stylesheet" media="screen">
        <style type="text/css">
            body { background: url(assets/bglight.png); }
            .hero-unit { background-color: #fff; }
            .center { display: block; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand">PHP Signup + Bootstrap Example</a>
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li><a href="register.php">Register</a></li>
                            <li class="divider-vertical"></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container hero-unit">
            <h2>Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, here's the secret content!</h2>
            <p>Check out the change in the navbar! Use the new "Log Out" button to do just that. Oh, were you expecting something more exciting on the secret page? Here, have this charming picture of the Earthbound crew crossing a street in Abbey Road fashion.</p>
            <p><img src="img/abbeybound.jpg" alt="" class="center" /></p>
        </div>

    </body>
</html>