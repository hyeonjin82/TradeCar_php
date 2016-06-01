<?php
require("config/database.php");
//instantiate Database
$database = new Database();
$db = $database->getConnection();

if (!empty($_POST)) {

    // Ensure that the user fills out fields 
    if (empty($_POST['username'])) {
        die("Please enter a username.");
    }
    if (empty($_POST['password'])) {
        die("Please enter a password.");
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid E-Mail Address");
    }
    if (empty($_POST['mobile'])) {
        die("Please enter a mobile.");
    }
    // instantiate user object
    include_once 'objects/user.php';
    $user = new User($db);
    // set product property values
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->email = $_POST['email'];
    $user->mobile = $_POST['mobile'];

    if ($user->register()) {
        echo "<div class=\"alert alert-success alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "You are signed up successfully.";
        echo "</div>";
    } else {  // if unable to login, tell the user
        echo "<div class=\"alert alert-danger alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Unable to sign up. Try again";
        echo "</div>";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Register Member</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap_1.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap.min_1.css" rel="stylesheet" media="screen">
        <style type="text/css">
            body { background: url(img/bglight.png); }
            .hero-unit { background-color: #fff; }
            .center { display: block; margin: 0 auto; }
        </style>
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
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li><a href="index.php">Return Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container hero-unit">
            <div class="col-md-8 col-md-offset-2">
                <h1>Register</h1><br/>
                <p style="color:darkred;">* Required Fields </p>
                <form class="form-horizontal" action="register.php" method="post"> 
                    <div class="form-group">
                        <label for="username" class="col-md-2 control-label">Username:
                            <strong style="color:darkred;">*</strong></label> 
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="username" value="" /> <br/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-2 control-label">Password:
                            <strong style="color:darkred;">*</strong></label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" name="password" value="" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: 
                            <strong style="color:darkred;">*</strong></label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="email" value="" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-md-2 control-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile: 
                            <strong style="color:darkred;">*</strong></label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="mobile" value="" /> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="submit" class="btn btn-info" value="Register" /> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>