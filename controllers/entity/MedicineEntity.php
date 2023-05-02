<?php

namespace app\controllers\entity;

use app\core\Logger;

class MedicineEntity extends \app\core\Controller
{

    public function getAllMedicines()
    {
        $allMedicines = (new \app\models\MedicineModel)->getAllMedicines();
        Logger::logDebug(print_r($allMedicines, true));
        return (new \app\models\MedicineModel)->getAllMedicines();
    }

}
