<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin Page</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap_1.min.js"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.min_1.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h3>USER LIST</h3>
            </div>
            <div class="row">
                <p>
                    <a href="../index.php" class="btn btn-primary">Home</a>
                    <a href="admin_create.php" class="btn btn-success">Create</a>
                </p>
                <?php
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Mobile</th>";
                echo "<th>Email Address</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // page given in URL parameter, default page is one
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // set number of records per page
                $records_per_page = 5;

                // calculate for the query LIMIT clause
                $from_record_num = ($records_per_page * $page) - $records_per_page;

                include_once '../objects/user.php';
                include_once '../config/database.php';

                // instantiate database and product object
//                        $pdo = Database::connection();
//                        $sql = 'SELECT id, username, password, email FROM users ORDER BY id DESC';
                $database = new Database();
                $db = $database->getConnection();
                $user = new User($db);
                // query products
                $stmt = $user->readAll($page, $from_record_num, $records_per_page);
                $num = $stmt->rowCount();

                if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr>";
                        echo "<td>{$username}</td>";
                        echo "<td>{$mobile}</td>";
                        echo "<td>{$email}</td>";
                        echo '<td width=250>';
                        echo '<a class="btn" href="read_admin.php?id=' . $id . '">Read</a>';
                        echo ' ';
                        echo '<a class="btn btn-success" href="admin_update.php?id=' . $id . '">Update</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="admin_delete.php?id=' . $id . '">Delete</a>';
                        echo '</td>';

                        echo "</tr>";
                    }
                }

//                        print_r($pdo->query($sql));
//                        if (is_array($pdo->query($sql))) {
//                            foreach ($pdo->query($sql) as $row) {
//                                echo '<tr>';
//                                echo '<td>' . $row['username'] . '</td>';
//                                echo '<td>' . $row['password'] . '</td>';
//                                echo '<td>' . $row['email'] . '</td>';
//                                echo '<td width=250>';
//                                echo '<a class="btn" href="read.php?id=' . $row['id'] . '">Read</a>';
//                                echo ' ';
//                                echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '">Update</a>';
//                                echo ' ';
//                                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>';
//                                echo '</td>';
//                                echo '</tr>';
//                            }
//                        }
//                        Database::disconnect();

                echo "</tbody>";
                echo "</table>";

                // paging buttons here
                include_once 'paging_admin.php';
                ?>
            </div>
        </div> <!-- /container -->
    </body>
</html>