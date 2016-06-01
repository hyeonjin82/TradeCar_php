<?php

class User {

    // database connection and table name
    private $conn;
    private $table_name = "users";
    // object properties
    public $id;
    public $username;
    public $mobile;
    public $password;
    public $salt;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // used by select drop-down list
    function read() {
        //select all data
        $query = "SELECT id, username, password, salt, email 
               FROM  " . $this->table_name . " 
              WHERE username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        $login_ok = false;
        $row = $stmt->fetch();
        if ($row) {
            $check_password = hash('sha256', $_POST['password'] . $row['salt']);
            for ($round = 0; $round < 65536; $round++) {
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            if ($check_password === $row['password']) {
                $login_ok = true;
            }
        }

        if ($login_ok) {
            unset($row['salt']);
            unset($row['password']);
            $_SESSION['username'] = $row;
            if ($_SESSION['username'][1] == "admin") {
                header("Location: admin/admin_page.php");
                die("Redirecting to: admin/admin_page.php");
            } else {
                header("Location: loginproduct.php");
                die("Redirecting to: loginproduct.php");
            }
        } else {
            print("Login Failed.");
        }

        return $login_ok;
    }

    function register() {

        //Check if the username is already taken
        $userquery = "SELECT 1
               FROM  " . $this->table_name . " 
              WHERE username = ?";

        $userstmt = $this->conn->prepare($userquery);
        $userstmt->bindParam(1, $this->username);
        $userstmt->execute();

        $userrow = $userstmt->fetch();
        if ($userrow) {
            die("This username is already in use");
        }

        // Check if the email is already taken
        $emailquery = "SELECT 1
               FROM  " . $this->table_name . " 
              WHERE email = ?";

        $emailstmt = $this->conn->prepare($emailquery);
        $emailstmt->bindParam(1, $this->email);
        $emailstmt->execute();

        $emailrow = $emailstmt->fetch();
        if ($emailrow) {
            die("This email is already in use");
        }

        // Add row to database 
        $insertquery = "INSERT INTO " . $this->table_name . " "
                . "SET username = ?, password = ?, salt = ?, email = ?, mobile = ?";

        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $this->password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $password = hash('sha256', $password . $salt);
        }

        $stmt = $this->conn->prepare($insertquery);

        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $salt);
        $stmt->bindParam(4, $this->email);
        $stmt->bindParam(5, $this->mobile);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        header("Location: register.php");
        die("Redirecting to register.php");
    }

    function readAll($page, $from_record_num, $records_per_page) {
        $query = "SELECT
                id, username, password, email, mobile
             FROM
                " . $this->table_name . "
            ORDER BY
                username ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // used for paging products
    public function countAll() {

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

}

?>