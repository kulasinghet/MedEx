<?php

namespace app\controllers;
use app\core\Controller;
use app\core\EmailServer;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\Request;
use app\models\LoginModel;
use app\models\PharmacyModel;
use PHPMailer\PHPMailer\Exception;

class LoginAuthController extends Controller
{
    const defaultView = 'general/login.php';
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());


            if ($login->validate()) {
                $userType = $login->login();
                if ($userType != 'unassigned') {
                    $_SESSION['userType'] = $userType;
                    $_SESSION['username'] = $request->getBody()['username'];
                    $_SESSION['user'] = $login->getUserInfo($request->getBody()['username']);

                    $logger = new Logger();
                    $logger->signInLog($_SESSION['user']['username']);

                    return header('Location: /dashboard');
                }
            }

            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
            $_SESSION['userType'] = null;
            return $this->render(self::defaultView);
        }
        return $this->render(self::defaultView);
    }

    /**
     * @throws Exception
     */
    public function forgotPassword(Request $request) {
        if ($request->isPost()) {

            $username = $request->getBody()['username'];
            $otp = $request->getBody()['otp'];
            $password = $request->getBody()['newPassword'];


            $login = new LoginModel();
            $result = $login->changePassword($username, $otp, $password);

            Logger::logDebug($username . " " . $otp . " " . $password);

            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'Password changed successfully']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong']);
            }

        } else if ($request->isGet()) {

            $username = $request->getParams()['username'];

            $login = new LoginModel();
            $otp = $login->generateOTP($username);

            Logger::logDebug($username . " " . $otp);

            $useremail = $login->getUserEmail($username);
            $email = new EmailServer();
            $result = $email->sendEmail($useremail, "Password Reset", "Your OTP is " . $otp);

            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'message' => 'OTP sent to your email', 'username' => $username]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong']);
            }

        }
    }
}
