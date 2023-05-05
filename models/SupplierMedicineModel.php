<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

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
        $sql = "SELECT quantity,unitPrice from supplier_medicine WHERE supplier_medicine.supName = '$supName' && verified='1' && supplier_medicine.medId = '$medid'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->quantity = $row['quantity'];
                $this->unitPrice = $row['unitPrice'];

            }
        }
        $db->close();
    }

    public function getQuantity($medid)
    {
        $this->getSupMed($medid, $_SESSION['username']);
        return $this->quantity;

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

    public function getSupMedicineFilter($uname, $search)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT medId,medicine.medName as name,verified,quantity,unitPrice from supplier_medicine JOIN medicine WHERE supplier_medicine.medId=medicine.id && supplier_medicine.supName = 'Tsup' && verified='1' && medName like '%$search%'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();

    }

    public function getLowSupMedicine($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT medId,quantity from supplier_medicine WHERE supplier_medicine.supName = '$uname' && verified='1' && quantity<50";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();

    }

    public function getSupMedCount($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT COUNT(medId) from supplier_medicine  WHERE supplier_medicine.supName = '$uname' && verified='1'";
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

    public function getPendingMedicineFilter($uname, $searchTerm)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT medId,medName,verified,quantity,unitPrice from supplier_medicine JOIN medicine WHERE medicine.id=supplier_medicine.medId AND supplier_medicine.supName = '$uname' && verified='0' AND medName like '%$searchTerm%'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();


    }
    public function getSupMedIds($uname)
    {
        Logger::logDebug("cALLED");
        $db = (new Database())->getConnection();
        $sql = "SELECT medId from supplier_medicine WHERE supplier_medicine.supName = '$uname' && verified='1' ";
        Logger::logDebug($sql);
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;

        }
        $db->close();


    }

    public function getQty($uname, $id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT quantity from supplier_medicine WHERE supplier_medicine.supName = '$uname' && supplier_medicine.medId = '$id' ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;

        }
        $db->close();


    }
    public function getUnitPrice($uname, $id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT unitPrice from supplier_medicine WHERE supplier_medicine.supName = '$uname' && supplier_medicine.medId = '$id' ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;

        }
        $db->close();


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

    public function DeleteMed($uname, $id)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "DELETE from  supplier_medicine WHERE supplier_medicine.supName = '$uname' && supplier_medicine.medId = '$id'";
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

    public function UpdateMed($uname, $id, $unitPrice, $quantity)
    { {
            $db = (new Database())->getConnection();
            try {
                $sql = "UPDATE supplier_medicine SET supplier_medicine.unitPrice = $unitPrice, supplier_medicine.quantity = $quantity WHERE supplier_medicine.supName = '$uname' && supplier_medicine.medId = '$id'";
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

    public function UpdateLabReport($uname, $medId, $status)
    {

        $db = (new Database())->getConnection();

        try {
            $sql = "UPDATE supplier_medicine SET supplier_medicine.verified = '$status' WHERE supplier_medicine.supName = '$uname' AND supplier_medicine.medId = '$medId'";
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


}