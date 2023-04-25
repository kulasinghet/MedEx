<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use app\models\HyperEntities\HyperDeliveryModel;
use app\models\HyperEntities\HyperLabModel;
use app\models\HyperEntities\HyperPharmacyModel;
use app\models\HyperEntities\HyperSupplierModel;
use mysqli;

class EmpApprovalsModel extends Model
{
    public function getAll(): array
    {
        $conn = $this->createConnection();
        $output = array_merge(
            $this->queryInvalidPharmacies($conn),
            $this->queryInvalidSuppliers($conn),
            //$this->queryInvalidDeliveryGuys($conn),
            //$this->queryInvalidLabs($conn)
            );
        $conn->close();
        return $output;
    }

    public function getInvalidPharmacies(): array
    {
        $conn = $this->createConnection();
        $output = $this->queryInvalidPharmacies($conn);
        $conn->close();
        return $output;
    }

    public function getInvalidSuppliers(): array
    {
        $conn = $this->createConnection();
        $output = $this->queryInvalidSuppliers($conn);
        $conn->close();
        return $output;
    }

    public function getInvalidDeliveryGuys(): array
    {
        $conn = $this->createConnection();
        $output = $this->queryInvalidDeliveryGuys($conn);
        $conn->close();
        return $output;
    }

    public function getInvalidLabs(): array
    {
        $conn = $this->createConnection();
        $output = $this->queryInvalidLabs($conn);
        $conn->close();
        return $output;
    }

    public function createConnection(): ?\mysqli
    {
        //loading the database
        $db = new Database();
        return $db->getConnection();
    }

    public function queryInvalidPharmacies(mysqli $conn): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`name`,`email`,`address`,`mobile` FROM `pharmacy` WHERE verified = 0";
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

    public function queryInvalidSuppliers(mysqli $conn): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`name`,`email`,`address`,`mobile` FROM `supplier` WHERE verified = 0";
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

    public function queryInvalidDeliveryGuys(mysqli $conn): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`name`,`email`,`address`,`mobile` FROM `delivery_partner` WHERE verified = 0";
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

    public function queryInvalidLabs(mysqli $conn): array
    {
        try {
            $output = array();
            $sql = "SELECT `username`,`laboratory_name`,`email`,`address`,`mobile` FROM `laboratory` WHERE verified = 0";
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