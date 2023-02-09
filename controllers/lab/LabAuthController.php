<?php
namespace app\controllers\lab;

use app\core\Controller;
use app\core\Request;

use app\models\LoginModel;
use app\models\LabModel;

class LabAuthController extends Controller
{
    public function labRegister(Request $request)
    {
        if ($request->isPost()) {
            $lab = new LabModel();
            $actor = new LoginModel();
            $lab->laboratory_name = $_POST["name"];
            $lab->username = $_POST["username"];
            $lab->email = $_POST["email"];
            $lab->address = $_POST["address"];
            $lab->mobile = $_POST["mobile"];
            $lab->business_registration_id = $_POST["busiRegNum"];
            $lab->laboratory_certificate_id = $_POST["labcertid"];


            // Uploading file

            $file1 = $_FILES["BusRegiCert"];
            $file2 = $_FILES["LabRegiCert"];
            $file_ext1 = explode('.', $file1['name']);
            $file_ext1 = strtolower(end($file_ext1));
            $file_ext2 = explode('.', $file2['name']);
            $file_ext2 = strtolower(end($file_ext2));


            if ($file1['size'] <= 3145728 && $file2['size'] <= 3145728) {
                $BusRegiCert_Name_New = $_POST["username"] . "BusRegiCert." . $file_ext1;
                $LabRegiCert_Name_New = $_POST["username"] . "LabRegiCert." . $file_ext2;
                $filedestination1 = '..\uploads\laboratory\businessRegCert' . DIRECTORY_SEPARATOR . $BusRegiCert_Name_New;
                $filedestination2 = '..\uploads\laboratory\labRegCert' . DIRECTORY_SEPARATOR . $LabRegiCert_Name_New;
                move_uploaded_file($file1['tmp_name'], $filedestination1);
                move_uploaded_file($file2['tmp_name'], $filedestination2);


            } else {
                echo (new \app\core\ExceptionHandler)->uploadtobig();
                return $this->render('/lab/register.php');
            }

            $lab->BusinessRegCertName = $BusRegiCert_Name_New;
            $lab->LabCertName = $LabRegiCert_Name_New;

            $actor->username = $_POST["username"];
            $actor->password = $_POST["pswd"];
            $actor->isSupplier = '0';
            $actor->isDelivery = '0';
            $actor->isLab = '1';
            $actor->isPharmacy = '0';
            $actor->isStaff = '0';


            if ($_POST['pswd'] != $_POST['re-pswd']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('/lab/register.php');
            }

            if ($actor->registerActor() && $lab->registerLab()) {
                echo (new \app\core\ExceptionHandler)->userCreated();
                return $this->render("/general/login.php");
            }



        }

        return $this->render('/lab/register.php');
    }

}