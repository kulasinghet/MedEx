<?php

namespace app\core;

use mysqli;

class Database
{

    private $servername = "3.83.240.41";
    private $username = "medex-remote";
    private $password = "Medex@2022";
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
