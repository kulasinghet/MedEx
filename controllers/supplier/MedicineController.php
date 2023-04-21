<?php
namespace app\controllers\supplier;

class MedicineController extends \app\core\Controller
{

    public function getAllMedicines() {
        $medcines = (new \app\models\MedicineModel)->getAllMedicines();
        return $medcines;
    }

}