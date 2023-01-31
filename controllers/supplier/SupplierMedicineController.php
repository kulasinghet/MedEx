<?php

namespace app\controllers\supplier;

class SupplierMedicineController extends \app\core\Controller
{

    public function getMedicinePrice($medId) {
        $price = (new \app\models\SupplierMedicineModel)->getMedicinePrice($medId);
        return $price;
    }

}