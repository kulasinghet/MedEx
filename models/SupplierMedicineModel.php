<?php

namespace app\models;

use app\core\Database;

class SupplierMedicineModel extends Model
{
    private $supId;
    private $medId;
    private $verified;
    private $quantity;
    private $unitPrice;

    /**
     * @return mixed
     */
    public function getSupId()
    {
        return $this->supId;
    }

    /**
     * @param mixed $supId
     */
    public function setSupId($supId): void
    {
        $this->supId = $supId;
    }

    /**
     * @return mixed
     */
    public function getMedId()
    {
        return $this->medId;
    }

    /**
     * @param mixed $medId
     */
    public function setMedId($medId): void
    {
        $this->medId = $medId;
    }

    /**
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @param mixed $verified
     */
    public function setVerified($verified): void
    {
        $this->verified = $verified;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getMedicinePrice($medId)
    {
        $db = new Database();
        try {
            $sql = "SELECT unitPrice FROM supplier_medicine WHERE medId = '$medId'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                return $result->fetch_assoc()['unitPrice'];
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

}