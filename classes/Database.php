<?php
class Database
{
    // DB Params
    private $host = 'localhost';
    private $db_name = 'gallery';
    private $username = "root";
    private $password  = "";
    private $conn;

    // DB Connect
    public function connect()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);

        return $this->conn;
    }
}
