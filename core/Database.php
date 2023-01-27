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

    public function getConnection()
    {
        $this->db = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        return $this->db;
    }

}
