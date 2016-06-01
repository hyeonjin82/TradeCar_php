<?php
session_start();
//login     
require("config/database.php");
$submitted_username = '';

//instantiate Database
$database = new Database();
$db = $database->getConnection();

if (!empty($_POST)) {
    // instantiate product object
    include_once 'objects/user.php';
    $user = new User($db);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->read()) {
        echo "<div class=\"alert alert-success alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "You are logined successfully.";
        echo "</div>";
    } else {  // if unable to login, tell the user
        echo "<div class=\"alert alert-danger alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Unable to login. Try again.";
        echo "</div>";
//        $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
    }
//    header("Location: loginproduct.php");
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
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jssor.slider.mini.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap.min_1.css" rel="stylesheet" media="screen">
        

        <style type="text/css">
            body { 
                background: url(img/car4.jpg) ; 
                background-size: 1400px 700px;
            }
            .hero-unit {
                background-color: #fff; 
            }
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
                            <li><a href="register.php">Register</a></li>
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                    <form action="index.php" method="post"> 
                                        Username:<br /> 
                                        <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                                        <br /><br /> 
                                        Password:<br /> 
                                        <input type="password" name="password" value="" /> 
                                        <br /><br /> 
                                        <input type="submit" class="btn btn-info" value="Login" /> 
                                    </form> 
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--        <div class="container hero-unit">
                    <h3>Come to Jin's Car Trader !!!! </h3>
                    <p>There are New arrival cars and we have every brand ~ </p>
                </div>-->
<!--        <div id="slider1_container" style="display: none; position: relative; margin: 0 auto;
             top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
             Loading Screen 
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
                     top: 0px; left: 0px; width: 100%; height: 100%;">
                </div>
                <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                     top: 0px; left: 0px; width: 100%; height: 100%;">
                </div>
            </div>
             Slides Container 
            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1300px; height: 500px; overflow: hidden;">
                <div>
                    <img u="image" src2="../img/1920/red.jpg" />
                </div>
                <div>
                    <img u="image" src2="../img/1920/purple.jpg" />
                </div>
                <div>
                    <img u="image" src2="../img/1920/blue.jpg" />
                </div>
            </div>

            #region Bullet Navigator Skin Begin 
             Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html 
            <style>
                /* jssor slider bullet navigator skin 21 css */
                /*
                .jssorb21 div           (normal)
                .jssorb21 div:hover     (normal mouseover)
                .jssorb21 .av           (active)
                .jssorb21 .av:hover     (active mouseover)
                .jssorb21 .dn           (mousedown)
                */
                .jssorb21 {
                    position: absolute;
                }
                .jssorb21 div, .jssorb21 div:hover, .jssorb21 .av {
                    position: absolute;
                    /* size of bullet elment */
                    width: 19px;
                    height: 19px;
                    text-align: center;
                    line-height: 19px;
                    color: white;
                    font-size: 12px;
                    background: url(../img/b21.png) no-repeat;
                    overflow: hidden;
                    cursor: pointer;
                }
                .jssorb21 div { background-position: -5px -5px; }
                .jssorb21 div:hover, .jssorb21 .av:hover { background-position: -35px -5px; }
                .jssorb21 .av { background-position: -65px -5px; }
                .jssorb21 .dn, .jssorb21 .dn:hover { background-position: -95px -5px; }
            </style>
             bullet navigator container 
            <div u="navigator" class="jssorb21" style="bottom: 26px; right: 6px;">
                 bullet navigator item prototype 
                <div u="prototype"></div>
            </div>
            #endregion Bullet Navigator Skin End 

            #region Arrow Navigator Skin Begin 
             Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html 
            <style>
                /* jssor slider arrow navigator skin 21 css */
                /*
                .jssora21l                  (normal)
                .jssora21r                  (normal)
                .jssora21l:hover            (normal mouseover)
                .jssora21r:hover            (normal mouseover)
                .jssora21l.jssora21ldn      (mousedown)
                .jssora21r.jssora21rdn      (mousedown)
                */
                .jssora21l, .jssora21r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 55px;
                    height: 55px;
                    cursor: pointer;
                    background: url(../img/a21.png) center center no-repeat;
                    overflow: hidden;
                }
                .jssora21l { background-position: -3px -33px; }
                .jssora21r { background-position: -63px -33px; }
                .jssora21l:hover { background-position: -123px -33px; }
                .jssora21r:hover { background-position: -183px -33px; }
                .jssora21l.jssora21ldn { background-position: -243px -33px; }
                .jssora21r.jssora21rdn { background-position: -303px -33px; }
            </style>
             Arrow Left 
            <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
            </span>
             Arrow Right 
            <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
            </span>
            #endregion Arrow Navigator Skin End 
            <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
        </div>-->



    </body>
</html>