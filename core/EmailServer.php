<?php

namespace app\core;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;
use InvalidArgumentException;
use PHPMailer\PHPMailer\SMTP;
use RuntimeException;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require __DIR__ . '/../vendor/autoload.php';

class EmailServer
{
    /**
     * @throws Exception
     */
    function sendEmail($to, $subject, $message): bool {

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->AltBody = 'This is a plain-text message body';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
            )
        );
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        if (!$mail->send()) {
            Logger::logError('Mailer Error: ' . $mail->ErrorInfo);
            return false;
        } else {
            Logger::logDebug('Message sent!');
            return true;
        }

    }



}
