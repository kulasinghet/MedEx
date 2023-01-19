<?php

namespace app\core;

use mysqli;

class Database
{

    private $servername = "medex.cf0qkfwuwc3x.us-east-1.rds.amazonaws.com";
    private $username = "medex";
    private $password = "rt182ifCi5I8WmSxfpp5";
    private $dbname = "medex";
    private mysqli $db;

    public function __construct()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $this -> db = $conn;
        }
    }

    public function prepare(string $sql)
    {
        return $this->db->prepare($sql);
    }
}
