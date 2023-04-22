<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use app\models\InvalidEntity\InvalidDeliveryModel;
use app\models\InvalidEntity\InvalidLabModel;
use app\models\InvalidEntity\InvalidPharmacyModel;
use app\models\InvalidEntity\InvalidSupplierModel;
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
            $sql = "SELECT * FROM `pharmacy` WHERE verified = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new InvalidPharmacyModel(array(
                        'username' => $row["username"],
                        'name' => $row["name"],
                        'ownerName' => $row["ownerName"],
                        'city' => $row["city"],
                        'phar_reg_no' => $row["pharmacyRegNo"],
                        'business_reg_id' => $row["BusinessRegId"],
                        'phar_cert_id' => $row["pharmacyCertId"],
                        'business_cert_name' => $row["BusinessRegCertName"],
                        'delivery_time' => $row["deliveryTime"],
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
            $sql = "SELECT * FROM `supplier` WHERE verified = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new InvalidSupplierModel(array(
                        'username' => $row["username"],
                        'name' => $row["name"],
                        'supp_reg_no' => $row["supplierRegNo"],
                        'business_reg_id' => $row["BusinessRegId"],
                        'supp_cert_id' => $row["supplierCertId"],
                        'business_cert_name' => $row["BusinessRegCertName"],
                        'supp_cert_name' => $row["supplierCertName"],
                        'reg_date' => $row["regDate"],
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
            $sql = "SELECT * FROM `delivery_partner` WHERE verified = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new InvalidDeliveryModel(array(
                        'username' => $row["username"],
                        'name' => $row["name"],
                        'city' => $row["city"],
                        'age' => $row["age"],
                        'licence_id' => $row["licence_id"],
                        'licence_name' => $row["driver_license_name"],
                        'vehicle_no' => $row["vehicle_no"],
                        'vehicle_type' => $row["vehicle_type"],
                        'delivery_location' => $row["delivery_location"],
                        'max_load' => $row["max_load"],
                        'reg_date' => $row["reg_date"],
                        'refrigerators' => $row["refrigerators"],
                        'license_photo' => $row["license_photo"],
                        'vehicle_reg_photo' => $row["vehicle_reg_photo"],
                        'vehicle_photo' => $row["vehicle_photo"],
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
            $sql = "SELECT * FROM `laboratory` WHERE verified = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new InvalidLabModel(array(
                        'username' => $row["username"],
                        'name' => $row["laboratory_name"],
                        'business_reg_id' => $row["business_registration_id"],
                        'lab_cert_id' => $row["laboratory_certificate_id"],
                        'business_cert_name' => $row["BusinessRegCertName"],
                        'lab_cert_name' => $row["LabCertName"],
                        'reg_date' => $row["reg_date"],
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