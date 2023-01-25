<?php

namespace app\controllers\entity;

class MedicineEntity extends \app\core\Controller
{

    public function getAllMedicines(): false|array|null
    {
        return (new \app\models\MedicineModel)->getAllMedicines();
    }

}
