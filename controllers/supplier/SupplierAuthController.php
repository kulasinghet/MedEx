<?php
namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Logger;
use app\core\Request;

use app\models\LoginModel;
use app\models\SupplierModel;

class SupplierAuthController extends Controller
{
    public function supplierRegister(Request $request)
    {
        if ($request->isPost()) {
            $supplier = new SupplierModel();
            $actor = new LoginModel();
            $supplier->name = $_POST["name"];
            $supplier->username = $_POST["username"];
            $supplier->email = $_POST["email"];
            $supplier->address = $_POST["address"];
            $supplier->mobile = $_POST["mobile"];
            $supplier->supplierRegNo = $_POST["supRegNum"];
            $supplier->BusinessRegId = $_POST["busiRegNum"];
            $supplier->supplierCertId = $_POST["supCertId"];


            // Uploading file

            $file1 = $_FILES["BusRegiCert"];
            $file2 = $_FILES["SuppRegiCert"];
            $file_ext1 = explode('.', $file1['name']);
            $file_ext1 = strtolower(end($file_ext1));
            $file_ext2 = explode('.', $file2['name']);
            $file_ext2 = strtolower(end($file_ext2));


            if ($file1['size'] <= 3145728 && $file2['size'] <= 3145728) {
                $BusRegiCert_Name_New = $_POST["username"] . "_businessRegCert.pdf";
                $SuppRegiCert_Name_New = $_POST["username"] . "_supplierCert.pdf";
                $filedestination1 = 'uploads\supplier\businessRegCert' . DIRECTORY_SEPARATOR . $BusRegiCert_Name_New;
                $filedestination2 = 'uploads\supplier\supplierRegCert' . DIRECTORY_SEPARATOR . $SuppRegiCert_Name_New;

                if (move_uploaded_file($file1['tmp_name'], $filedestination1) && move_uploaded_file($file2['tmp_name'], $filedestination2)) {
                    Logger::logDebug("File uploaded successfully" . "supplierRegCert" . $file_ext2);
                } else {
                    Logger::logError("File upload failed" . "supplierRegCert" . $file_ext2);
                    echo (new \app\core\ExceptionHandler)->fileUploadError();
                }

            } else {
                echo (new \app\core\ExceptionHandler)->uploadtobig();
                return $this->render('/supplier/register.php');
            }

            $supplier->BusinessRegCertName = $BusRegiCert_Name_New;
            $supplier->supplierCertName = $SuppRegiCert_Name_New;

            $actor->username = $_POST["username"];
            $actor->password = $_POST["pswd"];
            $actor->isSupplier = '1';
            $actor->isDelivery = '0';
            $actor->isLab = '0';
            $actor->isPharmacy = '0';
            $actor->isStaff = '0';


            if ($_POST['pswd'] != $_POST['re-pswd']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('/supplier/register.php');
            }

            if ($actor->registerActor() && $supplier->registerSupplier()) {
                echo (new \app\core\ExceptionHandler)->userCreated();
                return $this->render("/general/login.php");
            }



        }

        return $this->render('/supplier/register.php');
    }

}
