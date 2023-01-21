<?php

namespace app\core;

class NotificationHandler extends Logger
{
    private string $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model.css' rel='stylesheet'></head>";
    private string $closeClass   = "</div>";
    private string $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";

    public function userNameOrPasswordIncorrect($exceptionMessage)
    {


        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        return $this->scriptClass.$this->alertClass.$spanClass."Username or password is incorrect".$this->closeClass;

    }

    // user exists
    public function userExists($exceptionMessage)
    {
        $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass.$alertClass.$spanClass."User already exists".$closeClass;
//        Logger::logError("User already exists" . $exceptionMessage);
        return $message;
    }

    // password does not match
    public function passwordDoesNotMatch()
    {
        $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass.$alertClass.$spanClass."Password does not match".$closeClass;
        return $message;
    }

    public function emptyFields()
    {
        $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass.$alertClass.$spanClass."Please fill all the fields".$closeClass;
        return $message;
    }

    public function somethingWentWrong(): string
    {
        $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass.$alertClass.$spanClass."Something went wrong. Please try again".$closeClass;
        return $message;
    }

    public function userCreated()
    {
        $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-success' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass.$alertClass.$spanClass."User created successfully".$closeClass;
        return $message;
    }

    public function orderCreatedSuccessfully(String $pharmacyID)
    {
        Logger::orderLog($pharmacyID." pharmacy order created");

        $scriptClass  = "<head><script src='/js/pharmacy/login-error.js' defer></script><link href='/css/error-model' rel='stylesheet'></head>";
        $alertClass = "<div class='loginError alert alert-success' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $scriptClass.$alertClass.$spanClass."Order created successfully".$closeClass;
        return $message;
    }

}
