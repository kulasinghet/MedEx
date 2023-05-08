<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class MedicineModel extends Model
{
    public $id;
    public $medName;
    public $weight;
    public $volume;
    public $sciName;
    public $manId;

    // Add New Medicine by Supplier
    public function addMedicine()
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "INSERT INTO medicine (id, medName, weight,volume, sciName, manId)  VALUES ('$this->id', '$this->medName','$this->weight','$this->volume','$this->sciName','$this->manId')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    // Get Medicine details by id
    public function getMedicine($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from medicine WHERE medicine.id = '$id'";
        Logger::logDebug($sql);
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->id = $row["id"];
                $this->medName = $row["medName"];
                $this->weight = $row["weight"];
                $this->volume = $row['volume'];
                $this->sciName = $row["sciName"];
                $this->manId = $row["manId"];
            }
        }
        $db->close();

    }

    // Get Medicine Name
    public function getName($id)
    {
        $this->getMedicine($id);
        return $this->medName;

    }
    // Get Scientific Name
    public function getSciname($id)
    {
        $this->getMedicine($id);
        return $this->sciName;

    }

    // Get Weight
    public function getWeight($id)
    {
        $this->getMedicine($id);
        return $this->weight;

    }

    public function getVolume($id)
    {
        $this->getMedicine($id);
        return $this->volume;

    }

    public function getManufacture($id)
    {
        $this->getMedicine($id);
        return $this->manId;


    }

    // Get all medicine
    public function getAllMedicines()
    {

        $conn = (new Database())->getConnection();
        $sql = "SELECT m.id, m.medName, m.sciName, COALESCE(s.remQty, 0) AS remQty, sm.unitPrice AS price FROM medex.medicine m LEFT JOIN medex.stock s ON m.id = s.medId JOIN medex.supplier_medicine sm ON m.id = sm.medId WHERE m.id IN (SELECT medId FROM medex.supplier_medicine) AND sm.verified = 1 ORDER BY m.id;";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            Logger::logDebug('sql: ' . $sql);
            Logger::logDebug('MedicineModel::getAllMedicines()' . print_r($result, true));
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    // Get count of Medicine
    public function getCount()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from medicine";
        $result = $db->query($sql);
        $count = $result->num_rows + 1;
        $db->close();
        return $count;
    }


    // Get ids of all Medicine (to compare unadded medicine for a supplier)
    public function getallMedid()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id  from medicine";
        Logger::logDebug($sql);
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Get ids of all Medicine (to compare unadded medicine for a supplier - filter)
    public function getallMedidFilter($search)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id  from medicine WHERE medName like '%$search%'";
        Logger::logDebug($sql);
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }

        $db->close();
    }

    public function getMedicinePrice(mixed $id)
    {
        Logger::logDebug('MedicineModel::getMedicinePrice()' . $id);
        $db = (new Database())->getConnection();
        $sql = "SELECT sm.medId, sm.unitPrice as price FROM medex.supplier_medicine sm WHERE sm.medId = '$id' ORDER BY sm.medId LIMIT 1";

        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            Logger::logDebug($id . ' price: ' . $row['price']);
            return $row;
        }

        $db->close();
    }

    public function getRemQty(mixed $id, mixed $pharmacyUsername)
    {
        Logger::logDebug('MedicineModel::getRemQty()' . $id);
        $db = (new Database())->getConnection();
        $sql = "SELECT s.remQty FROM medex.stock s WHERE s.medId = '$id' AND s.pharmacyName = '$pharmacyUsername' ORDER BY s.medId LIMIT 1";

        // return the remQty
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $db->close();
        if (is_null($row)) {
            return 0;
        } else {
            return $row['remQty'];
        }


    }

}
