<?php
require 'config/database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {

    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id, username, password, email, mobile FROM users where id = ?";
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
//    $data = $q->fetch(PDO::FETCH_ASSOC);sss
//    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Read User</title>
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
        <div class="container">
            <form role="form">
                <h3>Read a Customer</h3>
                <div class="form-group">
                    <label class="control-label">User Name</label>
                   
                        <label class="control-label" >
                            <?php echo $username; ?>
                        </label>
                    
                </div>
                <div class="form-group">
                    <label class="control-label">Mobile</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $mobile; ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                        <label class="checkbox">
                            <?php echo $email; ?>
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <a class="btn" href="loginproduct.php">Back</a>
                </div>
            </form>
        </div>
    </body>
</html>