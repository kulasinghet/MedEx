<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\Logger;
use app\core\Request;
use app\models\PharmacyModel;

class PharmacyAuthController extends Controller
{
    public function pharmacyRegister(Request $request)
    {
        if ($request->isPost()) {

            $pharmacy = new PharmacyModel();

            if (@$_POST['password'] != @$_POST['confirmPassword']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('pharmacy/register-page.php');
            }

            if (!$pharmacy->validatePharmacy($request->getBody())) {
                return $this->render('pharmacy/register-page.php');
            }

            $pharmacyname = $_POST['username'];

            if ($pharmacy->userExists($_POST['username'])) {
                echo (new \app\core\ExceptionHandler)->userExists($pharmacyname);
                return $this->render('pharmacy/register-page.php');
            }


            if (!$this->handleFileUploads($request, $pharmacyname)) {
                echo (new \app\core\ExceptionHandler)->fileUploadError();
                return $this->render('pharmacy/register-page.php');
            }


            if ($pharmacy->registerPharmacy($request->getBody())) {

                $qr = new \app\core\QR();
                $qr_JSON = [
                    "username" => $_POST['username'],
                    "qrtype" => "pharmacy"
                ];
                $qr_name = $pharmacyname . "_qr";
                if ($qr->generateQRForPersonal(json_encode($qr_JSON), $qr_name, 10, 'L')) {
                    Logger::logDebug("QR generated for " . $_POST['username']);
                    return header("Location: /login");
                } else {
                    Logger::logError("QR generation failed for " . $_POST['username']);
                    echo (new \app\core\ExceptionHandler)->qrGenerationFailed();
                    return $this->render('pharmacy/register-page.php');
                }
            } else {
                echo (new \app\core\ExceptionHandler)->pharmacyRegistrationFailed();
                return $this->render('pharmacy/register-page.php');
            }

            return $this->render('pharmacy/register-page.php');
        }
        return $this->render('pharmacy/register-page.php');
    }

    private function handleFileUploads(Request $request, string $pharmacy)
    {
        try {

            if ($this->uploadPharmacyCert($request, $pharmacy) && $this->uploadBusinessRegCert($request, $pharmacy) && $this->uploadProfilePicture($request, $pharmacy)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new \app\core\ExceptionHandler)->fileUploadError();
            return false;
        }
    }

    public function uploadBusinessRegCert(Request $request, string $pharmacyname)
    {

        $businessRegCertName = $pharmacyname . "_businessRegCert";
        $target_dir = "uploads/pharmacy/businessRegCert/";
        // Create target directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // save the uploaded file with the name of the pharmacy
        $target_file = $target_dir . $businessRegCertName . "." . strtolower(pathinfo($_FILES["uploadbusinesscerti"]["name"], PATHINFO_EXTENSION));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            Logger::logError("File already exists"  . $target_file . " " . $businessRegCertName);
        }

        // Check file size
        if ($_FILES["uploadbusinesscerti"]["size"] > 10000000) {
            echo (new \app\core\ExceptionHandler)->fileTooLarge();
            $uploadOk = 0;
            Logger::logError("File too large"  . $target_file . " " . $businessRegCertName);
        }

        // Allow certain file formats
        if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo (new \app\core\ExceptionHandler)->invalidFileFormat();
            $uploadOk = 0;
            Logger::logError("Invalid file format"  . $target_file . " " . $businessRegCertName);
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES["uploadbusinesscerti"]["tmp_name"], $target_file)) {
                return true;
            } else {
                echo (new \app\core\ExceptionHandler)->fileUploadError();
                Logger::logError("File upload error"  . $target_file . " " . $businessRegCertName);
            }
        }
    }

    private function uploadPharmacyCert(Request $request, string $pharmacy)
    {
        $pharmacyCertName = $pharmacy . "_pharmacyCert";
        $target_dir = "uploads/pharmacy/pharmacyCert/";
        // Create target directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . $pharmacyCertName . "." . strtolower(pathinfo($_FILES["uploadpharceti"]["name"], PATHINFO_EXTENSION));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            Logger::logError("File already exists"  . $target_file . " " . $pharmacyCertName);
        }

        // Check file size
        if ($_FILES["uploadpharceti"]["size"] > 10000000) {
            echo (new \app\core\ExceptionHandler)->fileTooLarge();
            $uploadOk = 0;
            Logger::logError("File too large"  . $target_file . " " . $pharmacyCertName);
        }

        // Allow certain file formats
        if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo (new \app\core\ExceptionHandler)->invalidFileFormat();
            $uploadOk = 0;
            Logger::logError("Invalid file format"  . $target_file . " " . $pharmacyCertName);
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES["uploadpharceti"]["tmp_name"], $target_file)) {
                return true;
            } else {
                echo (new \app\core\ExceptionHandler)->fileUploadError();
                Logger::logError("File upload error"  . $target_file . " " . $pharmacyCertName);
            }
        }
    }

    private function uploadProfilePicture(Request $request, string $pharmacy)
    {
        $profilePictureName = $pharmacy . "_profilePicture" . ".png";
        $target_dir = "uploads/profilePicture/";
        // Create target directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . $profilePictureName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            // delete the file
            unlink($target_file);
            Logger::logError("File already exists"  . $target_file . " " . $profilePictureName);
        }

        // Check file size
        if ($_FILES["uploadprofilepic"]["size"] > 10000000) {
            Logger::logError('File too large' . $_FILES["uploadprofilepic"]["size"]);
            echo (new \app\core\ExceptionHandler)->fileTooLarge();
            $uploadOk = 0;
            Logger::logError("File too large"  . $target_file . " " . $profilePictureName);
        }

        // Allow certain file formats
        if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            Logger::logError('Invalid file format' . $imageFileType . ' profile picture');
            echo (new \app\core\ExceptionHandler)->invalidFileFormat();
            $uploadOk = 0;
            Logger::logError("Invalid file format"  . $target_file . " " . $profilePictureName);
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {
            if (move_uploaded_file($_FILES["uploadprofilepic"]["tmp_name"], $target_file)) {
                return true;
            } else {
                echo (new \app\core\ExceptionHandler)->fileUploadError();
                Logger::logError("File upload error"  . $target_file . " " . $profilePictureName);
            }
        }
    }


}
