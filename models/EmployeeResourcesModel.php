<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use mysqli;

class EmployeeResourcesModel extends Model
{
    public function getAll(bool $is_verified): array
    {
        $conn = $this->createConnection();
        $output = array_merge(
            $this->queryPharmacies($conn, $is_verified),
            $this->querySuppliers($conn, $is_verified),
            $this->queryDeliveryGuys($conn, $is_verified),
            $this->queryLabs($conn, $is_verified)
            );
        $conn->close();
        return $output;
    }

    public function getPharmacyList(bool $is_verified): array
    {
        $conn = $this->createConnection();
        $output = $this->queryPharmacies($conn, $is_verified);
        $conn->close();
        return $output;
    }

    public function getSupplierList(bool $is_verified): array
    {
        $conn = $this->createConnection();
        $output = $this->querySuppliers($conn, $is_verified);
        $conn->close();
        return $output;
    }

    public function getDeliveryGuysList(bool $is_verified): array
    {
        $conn = $this->createConnection();
        $output = $this->queryDeliveryGuys($conn, $is_verified);
        $conn->close();
        return $output;
    }

    public function getLabList(bool $is_verified): array
    {
        $conn = $this->createConnection();
        $output = $this->queryLabs($conn, $is_verified);
        $conn->close();
        return $output;
    }

    public function createConnection(): ?\mysqli
    {
        //loading the database
        $db = new Database();
        return $db->getConnection();
    }

    public function queryPharmacies(mysqli $conn, bool $is_verified): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`name`,`email`,`address`,`mobile` FROM `pharmacy` WHERE verified = ".($is_verified? "1" : "0").";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new HyperPharmacyModel(array(
                        'username' => $row["username"],
                        'name' => $row["name"],
                        'email' => $row["email"],
                        'address' => $row["address"],
                        'mobile' => $row["mobile"],
                    ));

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }

    public function querySuppliers(mysqli $conn, bool $is_verified): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`name`,`email`,`address`,`mobile` FROM `supplier` WHERE verified = ".($is_verified? "1" : "0").";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new HyperSupplierModel(array(
                        'username' => $row["username"],
                        'name' => $row["name"],
                        'email' => $row["email"],
                        'address' => $row["address"],
                        'mobile' => $row["mobile"],
                    ));

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }

    public function queryDeliveryGuys(mysqli $conn, bool $is_verified): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`name`,`email`,`address`,`mobile` FROM `delivery_partner` WHERE verified = ".($is_verified? "1" : "0").";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new HyperDeliveryModel(array(
                        'username' => $row["username"],
                        'name' => $row["name"],
                        'email' => $row["email"],
                        'address' => $row["address"],
                        'mobile' => $row["mobile"],
                    ));

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }

    public function queryLabs(mysqli $conn, bool $is_verified): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`laboratory_name`,`email`,`address`,`mobile` FROM `laboratory` WHERE verified = ".($is_verified? "1" : "0").";";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new HyperLabModel(array(
                        'username' => $row["username"],
                        'name' => $row["laboratory_name"],
                        'email' => $row["email"],
                        'address' => $row["address"],
                        'mobile' => $row["mobile"],
                    ));

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }
}