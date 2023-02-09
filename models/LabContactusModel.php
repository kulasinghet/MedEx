<?php

namespace app\models;
use app\core\Database;
use app\core\Logger;
use app\core\Request;
use DateTime;
use DateTimeZone;
class LabContactusModel extends Model
{
    public string $id;
    public string $subject;
    public string $message;
    public string $date;



    public function lab_contact_us()
    {
        $db = new Database();
        $date = new DateTime("now");
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $date = $date->format('Y/m/d');

        $this-> id = $this->createRandomID("LABCONT");
        try {
            $sql = "INSERT INTO lab_contact_us (id,subject, message,date) VALUES ('$this->id', '$this->subject', '$this->message', '$date')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();
                Logger::logError("Lab Contact us");
                return true;
            } else {
                Logger::logError("Lab Contact Us Error");
                $stmt->close();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

}