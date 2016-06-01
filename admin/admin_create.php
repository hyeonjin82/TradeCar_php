<?php
require '../config/database.php';

if (!empty($_POST)) {
    // keep track validation errors
    $userNameError = null;
    $mobileError = null;
    $emailError = null;

    // keep track post values
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    // validate input
    $valid = true;
    if (empty($username)) {
        $userNameError = 'Please enter User Name';
        $valid = false;
    }
    if (empty($mobile)) {
        $mobileError = 'Please enter Mobile';
        $valid = false;
    }
    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $database = new Database();
        $db = $database->getConnection();

        $query = "INSERT INTO users (username,password,salt,email,mobile) values(?, ?, ?, ?,?)";
        
        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $password = hash('sha256', $password . $salt);
        }
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $salt);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $mobile);
        $stmt->execute();

        header("Location: admin_page.php");

//        $pdo = Database::connect();
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
//        $q = $pdo->prepare($sql);
//        $q->execute(array($name, $email, $mobile));
//        Database::disconnect();
//        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap_1.min.js"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.min_1.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">

            <div class="span10 offset1">
                <div class="row">
                    <h3>Create a Customer</h3>
                </div>

                <form class="form-horizontal" action="admin_create.php" method="post">
                    <div class="control-group <?php echo!empty($usernameError) ? 'error' : ''; ?>">
                        <label class="control-label">User Name</label>
                        <div class="controls">
                            <input name="username" type="text"  placeholder="Name" value="<?php echo!empty($usernameError) ? $username : ''; ?>">
                            <?php if (!empty($usernameError)): ?>
                                <span class="help-inline"><?php echo $usernameError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php echo!empty($mobileError) ? 'error' : ''; ?>">
                        <label class="control-label">Mobile </label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile" value="<?php echo!empty($mobile) ? $mobile : ''; ?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php echo!empty($emailError) ? 'error' : ''; ?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo!empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Create</button>
                        <a class="btn" href="admin_page.php">Back</a>
                    </div>
                </form>
            </div>

        </div> <!-- /container -->
    </body>
</html>
