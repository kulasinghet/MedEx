<?php

namespace app\models;
use app\core\Database;
use app\core\Logger;
use app\core\Request;
use DateTime;
use DateTimeZone;
class DeliveryContactusModel extends Model
{
    public string $id;
    public string $subject;
    public string $message;
    public string $date;



    public function contactUs()
    {
        $db = new Database();
        $date = new DateTime("now");
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $date = $date->format('Y/m/d');
        try {
            $sql = "INSERT INTO contactus (id, subject, message,date) VALUES ('$this->id', '$this->subject', '$this->message', '$date')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

}