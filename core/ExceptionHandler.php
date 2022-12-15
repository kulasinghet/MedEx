<?php

namespace app\core;

class ExceptionHandler extends Logger
{
    private string $exceptionMessage;

    public function userNameOrPasswordIncorrect($exceptionMessage)
    {
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $alertClass.$spanClass."Username or password is incorrect".$closeClass;
//        Logger::logError("Username or password is incorrect" . $exceptionMessage);
        return $message;
    }

    // user exists
    public function userExists($exceptionMessage)
    {
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $alertClass.$spanClass."User already exists".$closeClass;
//        Logger::logError("User already exists" . $exceptionMessage);
        return $message;
    }

    // password does not match
    public function passwordDoesNotMatch()
    {
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $alertClass.$spanClass."Password does not match".$closeClass;
//        Logger::logError("Password does not match" . $exceptionMessage);
        return $message;
    }

    public function emptyFields()
    {
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $alertClass.$spanClass."Please fill all the fields".$closeClass;
        return $message;
    }

    public function somethingWentWrong(): string
    {
        $alertClass = "<div class='loginError alert alert-danger' id='loginError' role='alert'>";
        $spanClass = "<span class='closebtn' id='closebtn' style='padding-bottom: 0' onclick='this.parentElement.style.display='none';'>&times;</span>";
        $closeClass = "</div>";

        $message = $alertClass.$spanClass."Something went wrong. Please try again".$closeClass;
        return $message;
    }

}
