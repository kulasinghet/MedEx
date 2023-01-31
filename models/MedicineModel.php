<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class MedicineModel extends Model
{
    private $id;
    private $medName;
    private $weight;
    private $sciName;
    private $price;
    private $manId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMedName()
    {
        return $this->medName;
    }

    /**
     * @param mixed $medName
     */
    public function setMedName($medName): void
    {
        $this->medName = $medName;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getSciName()
    {
        return $this->sciName;
    }

    /**
     * @param mixed $sciName
     */
    public function setSciName($sciName): void
    {
        $this->sciName = $sciName;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getManId()
    {
        return $this->manId;
    }

    /**
     * @param mixed $manId
     */
    public function setManId($manId): void
    {
        $this->manId = $manId;
    }

    public function getAllMedicines() {
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

}