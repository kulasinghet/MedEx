<?php
namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;

use app\models\MedicineModel;
use app\models\LabRequestModel;
use app\models\SupplierMedicineModel;

class SupplierAddMedicineController extends Controller
{

    public function addMedicine(Request $request)
    {
        if ($request->isPost()) {
            $med = new MedicineModel;
            $supmed = new SupplierMedicineModel;
            $medcount = $med->getCount();
            $labreq = new LabRequestModel;
            $reqcount = $labreq->getCount();
            $med->id = 'Med000' . (string) $medcount;
            $med->manId = $_POST["manufacture"];
            $med->sciName = $_POST["sciname"];
            $med->medName = $_POST["name"];
            $med->weight = $_POST["weight"];
            $med->volume = $_POST["volume"];
            $labreq->id = 'Req000' . (string) $reqcount;
            $labreq->medId = 'Med000' . (string) $medcount;
            $labreq->SupName = $_SESSION['username'];
            $supmed->medId = 'Med000' . (string) $medcount;
            $supmed->quantity = 0;
            $supmed->supName = $_SESSION['username'];
            $supmed->unitPrice = 0;

            if ($med->weight < 1 && $med->volume < 1) {
                echo (new \app\core\ExceptionHandler)->inValidWeight();
                return $this->render("/supplier/add-medicine.php");

            } else {
                if ($med->addMedicine() && $labreq->addRequest() && $supmed->addMedicine()) {
                    echo (new \app\core\ExceptionHandler)->RequestSent();
                    return $this->render("/supplier/add-medicine.php");
                }
            }



        }

        return $this->render('/supplier/add-medicine.php');
    }

    public function addExsisting(Request $request)
    {
        if ($request->isPost()) {
            $labreq = new LabRequestModel;
            $supmed = new SupplierMedicineModel;
            $reqcount = $labreq->getCount();
            $labreq->id = 'Req000' . (string) $reqcount;
            $labreq->medId = $_POST["id"];
            $labreq->SupName = $_SESSION['username'];
            $supmed->medId = $_POST["id"];
            $supmed->quantity = 0;
            $supmed->supName = $_SESSION['username'];
            $supmed->unitPrice = 0;

            if ($labreq->addRequest() && $supmed->addMedicine()) {
                echo (new \app\core\ExceptionHandler)->RequestSent();
                return $this->render("/supplier/add-medicine.php");
            }


        }

        return $this->render('/supplier/add-medicine.php');
    }

}