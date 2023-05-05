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
            ErrorLog::logError($e->getMessage());
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
        $sql = "SELECT medicine.*, COALESCE(stock.remQty, 0) AS remQty FROM medicine LEFT JOIN stock ON medicine.id = stock.medId;";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
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


    // Get ids of all Medicine (to compare unadded medicine for a supplier
    public function getallMedid()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id  from medicine";
        Logger::logDebug($sql);
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }

        $db->close();
    }

    // Get ids of all Medicine (to compare unadded medicine for a supplier - filter
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

}