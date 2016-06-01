<?php
class Database{
 
    // specify your own database credentials
    private  $host = "localhost";
    private  $username = "root";
    private  $password = "abc4343";
    private  $db_name = "final_project";
    public   $conn;
 
//    public function __construct() {
//        die('Init function is not allowed');
//    }
    
    // get the database connection
    public function getConnection(){
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
//    public static function connection(){
//         // One connection through whole application
//       if ( null == self::$conn )
//       {     
//        try
//        {
//          self::$conn =  new PDO( "mysql:host=".self::$host.";"."dbname=".self::$db_name, self::$username, self::$password); 
//        }
//        catch(PDOException $e)
//        {
//          die($e->getMessage()); 
//        }
//       }
//       return self::$conn;
//    }
//    public static function disconnect(){
//        self::$conn = null;
//    }
}
?>