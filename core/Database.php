<?php

namespace app\core;

use mysqli;

class Database
{

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "medex";
    private mysqli $db;

    public function getConnection()
    {
        $this->db = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        return $this->db;
    }

}