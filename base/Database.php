<?php

namespace app\base;

use mysqli;

class Database
{
    public mysqli $db;
    private $servername = "localhost";
    private $username = "root";
//    private $password = "";
    private $password = "Medex@2022";
    private $dbname = "medex";
//    private mysqli $db;

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