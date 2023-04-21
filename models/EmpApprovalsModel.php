<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class EmpApprovalsModel extends Model
{
    private array $invalid_pharmacy_list;
    private array $invalid_supplier_list;
    private array $invalid_delivery_guys_list;
    private array $invalid_lab_list;

    public function getInvalids() {
        //todo
    }

    public function getInvalidPharmacies(): array
    {
        if ($this->invalid_pharmacy_list == null || $this->invalid_pharmacy_list == []) {
            $this->queryInvalidPharmacies();
        }
        return $this->invalid_pharmacy_list;
    }

    public function getInvalidSuppliers(): array
    {
        if ($this->invalid_supplier_list == null || $this->invalid_supplier_list == []) {
            $this->queryInvalidSuppliers();
        }
        return $this->invalid_supplier_list;
    }

    public function getInvalidDeliveryGuys(): array
    {
        if ($this->invalid_delivery_guys_list == null || $this->invalid_delivery_guys_list == []) {
            $this->queryInvalidDeliveryGuys();
        }
        return $this->invalid_delivery_guys_list;
    }

    public function getInvalidLabs(): array
    {
        if ($this->invalid_lab_list == null || $this->invalid_lab_list == []) {
            $this->queryInvalidLabs();
        }
        return $this->invalid_lab_list;
    }

    public function queryInvalidPharmacies(): void
    {
        //loading the database
        $db = new Database();
        $conn = $db.getConnection();

        try {
            $sql = "SELECT * FROM pharmacy WHERE verified = 0";
            $result = $db->query($sql);
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
                    $this->invalid_pharmacy_list[] = $tmp;
                }
            }
            $db->close();
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
        }
    }

    public function queryInvalidSuppliers(): void
    {
        //loading the database
        $db = new Database();
        $conn = $db.getConnection();

        try {
            $sql = "SELECT * FROM supplier WHERE verified = 0";
            $result = $db->query($sql);
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
                    $this->invalid_supplier_list[] = $tmp;
                }
            }
            $db->close();
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
        }
    }

    public function queryInvalidDeliveryGuys(): void
    {
        //loading the database
        $db = new Database();
        $conn = $db.getConnection();

        try {
            $sql = "SELECT * FROM delivery_partner WHERE verified = 0";
            $result = $db->query($sql);
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
                    $this->invalid_delivery_guys_list[] = $tmp;
                }
            }
            $db->close();
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
        }
    }

    public function queryInvalidLabs(): void
    {
        //loading the database
        $db = new Database();
        $conn = $db.getConnection();

        try {
            $sql = "SELECT * FROM laboratory WHERE verified = 0";
            $result = $db->query($sql);
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
                    $this->invalid_lab_list[] = $tmp;
                }
            }
            $db->close();
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
        }
    }
}