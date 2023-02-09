<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class PharmacyOrderModel extends Model
{
    public $id;
    public $pharmacyName;
    public $medId;
    public $quantity;
    public $status;
    public $supName;


    public function getOrder($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from pharmacyorder WHERE pharmacyorder.id = '$id'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->id = $row["id"];
                $this->pharmacyName = $row['pharmacyName'];
                $this->medId = $row['medId'];
                $this->quantity = $row['quantity'];

            }
        }
        $db->close();
    }
    public function getPendingOrders()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id from pharmacyorder WHERE pharmacyorder.status = '0'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();
    }

    public function getPendingMedId($id)
    {
        $this->getOrder($id);
        return $this->medId;
    }

    public function getPendingMedQuantiy($id)
    {
        $this->getOrder($id);
        return $this->quantity;
    }

    public function getPendingOrderPharm($id)
    {
        $this->getOrder($id);
        return $this->pharmacyName;
    }

    public function acceptOrder($supName, $id)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "UPDATE  pharmacyorder SET pharmacyorder.status = '1', pharmacyorder.supName='$supName' WHERE pharmacyorder.id = '$id' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }

    }
}