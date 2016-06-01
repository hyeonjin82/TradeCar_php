<?php
require '../config/database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: admin_page.php");
}

if (!empty($_POST)) {
    // keep track validation errors
    $userNameError = null;
    $emailError = null;
    $mobileError = null;


    // keep track post values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];


    // validate input
    $valid = true;
    if (empty($username)) {
        $userNameError = 'Please enter User Name';
        $valid = false;
    }
    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }
    if (empty($mobile)) {
        $mobileError = 'Please enter Mobile';
        $valid = false;
    }



    // update data
    if ($valid) {
        // instantiate database and product object
        $database = new Database();
        $db = $database->getConnection();

        $query = "UPDATE users  set username = ?, email =? , mobile = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $mobile);
        $stmt->bindParam(4, $id);
        $stmt->execute();

        header("Location: admin_page.php");

//        $pdo = Database::connect();
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $sql = "UPDATE customers  set name = ?, email = ?, mobile =? WHERE id = ?";
//        $q = $pdo->prepare($sql);
//        $q->execute(array($name, $email, $mobile, $id));
//        Database::disconnect();
//        header("Location: index.php");
    }
} else {

    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM users where id = ?";

    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $num = $stmt->rowCount();
    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    }

//    $pdo = Database::connect();
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $sql = "SELECT * FROM customers where id = ?";
//    $q = $pdo->prepare($sql);
//    $q->execute(array($id));
//    $data = $q->fetch(PDO::FETCH_ASSOC);
//    $name = $data['name'];
//    $email = $data['email'];
//    $mobile = $data['mobile'];
//    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
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
                    <h3>Update a Customer</h3>
                </div>
                <form class="form-horizontal" action="admin_update.php?id=<?php echo $id ?>" method="post">
                    <div class="control-group <?php echo!empty($usernameError) ? 'error' : ''; ?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="username" type="text"  placeholder="Name" value="<?php echo!empty($username) ? $username : ''; ?>">
                            <?php if (!empty($usernameError)): ?>
                                <span class="help-inline"><?php echo $usernameError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php echo!empty($mobileError) ? 'error' : ''; ?>">
                        <label class="control-label">Mobile Number</label>
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
                        <button type="submit" class="btn btn-success">Update</button>
                        <a class="btn" href="admin_page.php">Back</a>
                    </div>
                </form>
            </div>
        </div> <!-- /container -->
    </body>
</html>