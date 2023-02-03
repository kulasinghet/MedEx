<?php

namespace app\models;

use app\core\Database;

class SupplierMedicineModel extends Model
{
    public $supName;
    public $medId;
    public $verified;
    public $quantity;
    public $unitPrice;
    public function addMedicine()
    {

        $db = (new Database())->getConnection();

        try {
            $sql = "INSERT INTO supplier_medicine(supName, medId, verified, quantity, unitPrice) VALUES ('$this->supName','$this->medId','0','$this->quantity','$this->unitPrice')";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function getSupMedicine($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT medId,verified,quantity,unitPrice from supplier_medicine WHERE supplier_medicine.supName = '$uname'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();


    }


}