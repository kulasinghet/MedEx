<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class PharmacyOrderModel extends Model
{
    private $id;
    private $pharmacyId;
    private $medId = "";
    private $quantity;/**
 * @return mixed
 */
    public function getId()
    {
        return $this->id;
    }/**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }/**
     * @return mixed
     */
    public function getPharmacyId()
    {
        return $this->pharmacyId;
    }/**
     * @param mixed $pharmacyId
     */
    public function setPharmacyId($pharmacyId): void
    {
        $this->pharmacyId = $pharmacyId;
    }/**
     * @return mixed
     */
    public function getMedId(): mixed
    {
        return $this->medId;
    }/**
     * @param mixed $medId
     */
    public function setMedId($medId): void
    {
        $this->medId = $medId;
    }/**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }/**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function createOrder($pharmacyId, $quantity): bool
    {
        // generate random order id with time stamp and pharmacy id

        $this->setId($this->createRandomID($pharmacyId));
        $this->setPharmacyId($pharmacyId);
//        $this->setMedId($medId);
        $this->setQuantity($quantity);

        $sql = "INSERT INTO pharmacy_order (id, pharmacy_id, med_id, quantity) VALUES ('$this->getId()', '$this->getPharmacyId()', '$this->getMedId()', '$this->getQuantity()');";

        try {

            $db = new Database();
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                (new \app\core\Logger)->orderCreated($this->getId() . $this->getPharmacyId() . $this->getMedId() . $this->getQuantity());
                return true;
            } else {
                Logger::logError($this->getId() . "Order creation failed");
                echo (new ExceptionHandler)->somethingWentWrong();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getOrdersByPharmacyId($pharmacyId): false|array
    {
//        Logger::logError("Pharmacy order history fetched");
        $sql = "SELECT * FROM pharmacy_order WHERE pharmacyId = '$pharmacyId';";

        try {
            $db = new Database();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            $result = $result->fetch_all(MYSQLI_ASSOC);

//            if (@$result['order_status'] == 0) {
//                $result['order_status'] = "Pending";
//            } else if ($result['order_status'] == 1) {
//                $result['order_status'] = "Approved";
//            } else if ($result['order_status'] == 2) {
//                $result['order_status'] = "Rejected";
//            } else if ($result['order_status'] == 3) {
//                $result['order_status'] = "Delivered";
//            } else {
//                $result['order_status'] = "Unknown";
//            }
//
//            if (@$result['delivery_date'] == null) {
//                $result['delivery_date'] = "Pending";
//            }

            return $result;


        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }


}
