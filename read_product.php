<?php
require 'config/database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: admin_page.php");
} else {

    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id, name, description, price, madeyear, km, category_id, created FROM products where id = ?";
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
            <div class="span10 offset1">
                <div class="row">
                    <h3>Read a User</h3>
                </div>
                <div class="form-horizontal" >
                    <div class="control-group">
                        <label class="control-label">Make</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $name; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $price; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Made Years</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $madeyear; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">KM</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $km; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $description; ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a class="btn" href="loginproduct.php">Back</a>
                    </div>
                </div>
            </div>
        </div> <!-- /container -->
    </body>
</html>