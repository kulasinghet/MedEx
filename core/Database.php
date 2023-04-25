<?php

namespace app\core;

use mysqli;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class Database
{

    private mysqli $db;

    public function getConnection()
    {
//        $this->db = new mysqli($this->parse_env('DB_HOST'), $this->username, $this->password, $this->database, $this->port);
        $this->db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE'], $_ENV['DB_PORT']);

        if ($this->db->connect_error) {
            Logger::logError("Connection failed: " . $this->db->connect_error);
            die("Connection failed: " . $this->db->connect_error);
        }


        return $this->db;
    }
}
