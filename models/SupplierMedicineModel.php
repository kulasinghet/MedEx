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

    public function getSupMed($medid, $supName)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from supplier_medicine WHERE supplier_medicine.supName = '$supName' && verified='1'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->quantity = $row['quantity'];
                @$this->unitPrice = $row['$unitPrice'];
            }
        }
        $db->close();
    }

    public function getQuantity($medid)
    {
        $this->getSupMed($medid, $_SESSION['username']);
        return $this->quantity;

    }
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
        $sql = "SELECT medId,verified,quantity,unitPrice from supplier_medicine WHERE supplier_medicine.supName = '$uname' && verified='1'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();


    }
    public function getPendingMedicine($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT medId,verified,quantity,unitPrice from supplier_medicine WHERE supplier_medicine.supName = '$uname' && verified='0'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();


    }

    public function getSupMedIds($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT medId from supplier_medicine WHERE supplier_medicine.supName = '$uname'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;

        }
        $db->close();


    }



    public function acceptOrder($qauntity, $id, $uname)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "UPDATE supplier_medicine SET supplier_medicine.quantity = '$qauntity' WHERE supplier_medicine.supName = '$uname' AND supplier_medicine.medId = '$id'";
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
