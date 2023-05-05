<?php
namespace app\core;

class ExceptionHandler extends Logger
{
    private string $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>";
    private string $closeClass = "</div>";
    private string $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";

    public function userNameOrPasswordIncorrect($exceptionMessage)
    {


        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass . $this->alertClass . $spanClass . "Username or password is incorrect" . $this->closeClass;

    }

    // user exists
    public function userExists($exceptionMessage)
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "User already exists" . $closeClass;
        //        Logger::logError("User already exists" . $exceptionMessage);
        return $message;
    }

    // password does not match
    public function passwordDoesNotMatch()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass . $this->alertClass . $spanClass . "Password doesnt match" . $this->closeClass;
    }

    public function emptyFields()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "Please fill all the fields" . $closeClass;
        return $message;
    }

    public function somethingWentWrong(): string
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "Something went wrong. Please try again" . $closeClass;
        return $message;
    }

    public function userCreated()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "User Created!" . "</div>";
    }

    public function inValidWeight()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass . $this->alertClass . $spanClass . "Invalid Weight or Volume" . $this->closeClass;
    }
    public function inValidQty()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass . $this->alertClass . $spanClass . "Invalid Quantity" . $this->closeClass;
    }
    public function inValidUnitP()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass . $this->alertClass . $spanClass . "Invalid Unit Price" . $this->closeClass;
    }

    public function RequestSent()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "New Medicine Request Sent!" . "</div>";
    }

    public function OrderAccepted()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "Order Accepteds!" . "</div>";
    }
    public function InquirySent()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "Inquiry Sent!" . "</div>";
    }
    public function DeleteCompleted()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "Medicine Deleted from Inventory!" . "</div>";
    }

    public function UpdateCompleted()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "Medicine Updated Sucessfully!" . "</div>";
    }

    public function loginFirst()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "Please login first" . $closeClass;
        return $message;
    }

    public function orderCreatedSuccessfully()
    {

    }

    public function userNotAssigned(mixed $username)
    {
    }

    public function uploadtobig()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass . $this->alertClass . $spanClass . "Upload files too big" . $this->closeClass;
    }


    public function RequestAccepted()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . " Lab Request Accepted !" . "</div>";
    }


    public function fileAlreadyExists()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "File already exists" . $closeClass;
        return $message;
    }

    public function fileTooLarge()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "File too large" . $closeClass;
        return $message;
    }

    public function invalidFileFormat()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "Invalid file format" . $closeClass;
        return $message;
    }

    public function fileUploadError()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "File upload error" . $closeClass;
        return $message;
    }

    public function pharmacyRegistrationSuccess()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . "Pharmacy Registration Success!" . "</div>";
    }

    public function pharmacyRegistrationFailed()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: red;'>" . $spanClass . "Pharmacy Registration Failed!" . "</div>";
    }

    public function invalidEmail()
    {
        $scriptClass = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass . $alertClass . $spanClass . "Invalid Email" . $closeClass;
        return $message;
    }

    public function qrGenerationFailed()
    {
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: red;'>" . $spanClass . "QR Generation Failed!" . "</div>";
    }


    public function LabReportIssued()
    {

        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>" . "<div class='loginError alert alert-danger' id='loginError' role='alert' style='background-color: green;'>" . $spanClass . " Lab Report Issued !" . "</div>";
    }
}