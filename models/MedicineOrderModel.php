<?php

namespace app\models;

class MedicineOrderModel
{
    private $medicineId;
    private $quantity;

    public function __construct($medicineId, $quantity)
    {
        $this->medicineId = $medicineId;
        $this->quantity = $quantity;
    }

    public function getMedicineId()
    {
        return $this->medicineId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

}
