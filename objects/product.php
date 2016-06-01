<?php

class Product {

    // database connection and table name
    private $conn;
    private $table_name = "products";
    // object properties
    public $id;
    public $name;
    public $madeyear;
    public $madeyearfrom;
    public $madeyearto;
    public $price;
    public $pricefrom;
    public $priceto;
    public $km;
    public $kmfrom;
    public $kmto;
    public $description;
    public $category_id;
    public $timestamp;

    public function __construct($db) {
        $this->conn = $db;
    }

    // create product
    function create() {

        // to get time-stamp for 'created' field
        $this->getTimestamp();

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name = ?, price = ?, madeyear = ?, km = ? ,description = ?, category_id = ?, created = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->price);
        $stmt->bindParam(3, $this->madeyear);
        $stmt->bindParam(4, $this->km);
        $stmt->bindParam(5, $this->description);
        $stmt->bindParam(6, $this->category_id);
        $stmt->bindParam(7, $this->timestamp);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // used for the 'created' field when creating a product
    function getTimestamp() {
        date_default_timezone_set('Asia/Manila');
        $this->timestamp = date('Y-m-d H:i:s');
    }

    function readAll($page, $from_record_num, $records_per_page) {

        $query = "SELECT
                id, name, description, price, category_id
            FROM
                " . $this->table_name . "
            ORDER BY
                name ASC
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

    function readOne() {

        $query = "SELECT
                name, price, description, category_id
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
    }

    function update() {

        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                price = :price,
                description = :description,
                category_id  = :category_id
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

// delete the product
    function delete() {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function search($page, $from_record_num, $records_per_page) {
        $query = "SELECT a.id, a.name, a.description, a.price, a.madeyear, a.km, a.category_id 
                    FROM products a 
                    WHERE a.name like ?
                      and a.price between ? and ?
                      and a.km between ? and ?
                      and a.madeyear between ? and ?
                      and a.category_id like ?
                     LIMIT
             {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam( 1 , $this->name, PDO::PARAM_STR, 12);
        $stmt->bindParam( 2 , $this->pricefrom);
        $stmt->bindParam( 3 , $this->priceto);
        $stmt->bindParam( 4 , $this->kmfrom);
        $stmt->bindParam( 5 , $this->kmto);
        $stmt->bindParam( 6 , $this->madeyearfrom);
        $stmt->bindParam( 7 , $this->madeyearto);
        $stmt->bindParam( 8, $this->category_id, PDO::PARAM_STR, 12);

        $stmt->execute();

        return $stmt;
    }

}

?>