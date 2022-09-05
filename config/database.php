<?php
class Database
{
    // define variables
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "products";
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if(!$this->conn){
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function get_connection()
    {
        return $this->conn;
    }

    public function get_data()
    {
        $sql = 'SELECT * FROM product';
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    // create function to insert data
    public function insert_data($sku, $name, $price, $size, $height, $width, $length, $weight)
    {
        $sql = "INSERT INTO product (sku, name, price, size, height, width, length, weight) VALUES ('$sku', '$name', '$price', '$size', '$height', '$width', '$length', '$weight')";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    // create function to delete data
    public function delete_data($id)
    {
        $sql = "DELETE FROM product WHERE sku = '$id'";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    // create function to close connection
    public function close_connection()
    {
        mysqli_close($this->conn);
    }
}    
$db = new Database();
?>
