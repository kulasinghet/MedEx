<?php

namespace app\controllers\entity;

class MedicineEntity extends \app\core\Controller
{

    public function getAllMedicines()
    {
        return (new \app\models\MedicineModel)->getAllMedicines();
    }

}
