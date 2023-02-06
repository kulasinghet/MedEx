<?php

namespace app\models;

use app\core\Database;
use DateTime;
use DateTimeZone;
use app\core\Logger;


class LabRequestModel extends Model
{
    public $id;
    public $medId;
    public $SupName;
    public $recivedDate;
    public $status;

    // Add Supplier Lab Requests
    public function addRequest()
    {
        $db = (new Database())->getConnection();

        $recivedDate = new DateTime("now");
        $recivedDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $recivedDate = $recivedDate->format('Y/m/d');
        try {
            $sql = "INSERT INTO labreq (id, medId, SupName, recivedDate, status) VALUES ('$this->id','$this->medId','$this->SupName','$recivedDate','0')";
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

    // Get Lab Requests Counts
    public function getCount()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from labreq";
        $result = $db->query($sql);
        $count = $result->num_rows + 1;
        $db->close();
        return $count;
    }

    // Get Req ID for a supplier
    public function getSupMedReq($medid, $supid)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT  id, status from labreq WHERE  labreq.medId = '$medid' AND labreq.SupName ='$supid' ;";
        $result = $db->query($sql);
        $db->close();
        return $result;

    }

}