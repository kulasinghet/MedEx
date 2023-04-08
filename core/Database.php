<?php

namespace app\core;

use mysqli;

class Database
{

    private $host = "medex-do-user-10529241-0.b.db.ondigitalocean.com";
    private $port = "25060";
    private $username = "doadmin";
    private $password = "AVNS_1XxLJaaCdF9zuxtb5bR";
    private $database = "medex";
    private $sslmode = "REQUIRED";
    private mysqli $db;

    public function getConnection()
    {
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);
        if ($this->db->connect_error) {
            Logger::logError("Connection failed: " . $this->db->connect_error);
            die("Connection failed: " . $this->db->connect_error);
        }
        return $this->db;
    }


}
