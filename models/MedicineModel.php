<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class MedicineModel extends Model
{
    public $id;
    public $medName;
    public $weight;
    public $sciName;
    public $manId;

    public function addMedicine()
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "INSERT INTO medicine (id, medName, weight, sciName, manId)  VALUES ('$this->id', '$this->medName','$this->weight','$this->sciName','$this->manId')";
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
    public function getMedicine($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from medicine WHERE medicine.id = '$id'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->id = $row["id"];
                $this->medName = $row["medName"];
                $this->weight = $row["weight"];
                $this->sciName = $row["sciName"];
                $this->manId = $row["manId"];
            }
        }
        $db->close();

    }

    public function getName($id)
    {
        $this->getMedicine($id);
        return $this->medName;

    }
    public function getSciname($id)
    {
        $this->getMedicine($id);
        return $this->sciName;

    }

    public function getWeight($id)
    {
        $this->getMedicine($id);
        return $this->weight;

    }

    public function getAllMedicines()
    {
        $db = new Database();
        $sql = "SELECT * FROM medicine";

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getCount()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from medicine";
        $result = $db->query($sql);
        $count = $result->num_rows + 1;
        $db->close();
        return $count;
    }

}