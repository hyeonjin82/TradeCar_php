<?php
require '../config/database.php';
$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];

    // delete user
    $database = new Database();
    $db = $database->getConnection();

    $query = "DELETE FROM users  WHERE id = ?";

    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    header("Location: admin_page.php");

//        // delete data
//        $pdo = Database::connect();
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $sql = "DELETE FROM customers  WHERE id = ?";
//        $q = $pdo->prepare($sql);
//        $q->execute(array($id));
//        Database::disconnect();
//        header("Location: index.php");
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
                    <h3>Delete a User</h3>
                </div>

                <form class="form-horizontal" action="admin_delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <p class="alert alert-error">Are you sure to delete ?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <a class="btn" href="admin_page.php">No</a>
                    </div>
                </form>
            </div>

        </div> <!-- /container -->
    </body>
</html>