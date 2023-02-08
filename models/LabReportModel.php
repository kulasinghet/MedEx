<?php

namespace app\models;

use app\core\Database;
use DateTime;
use DateTimeZone;
use app\core\Logger;


class LabReportModel extends Model
{
    public $reqId;
    public $labName;
    public $comment;
    public $verified;

    // Accept Lab Report
    public function acceptReport()
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "INSERT INTO labreport (reqId, labName, comment, verified) VALUES ('$this->reqId','$this->labName','Test Pending','0')";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

}