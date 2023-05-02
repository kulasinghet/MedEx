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
    public $issued;
    // Accept Lab Report
    public function acceptReport($reqid, $labname)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "INSERT INTO labreport (reqId, labName, comment,verified,issued) VALUES ('$reqid', '$labname','Test Pending','0','0')";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function PendingReportsDropDown($labName)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT reqId FROM labreport WHERE issued = '0' ";
        $result = $db->query($sql);
        var_dump($result);
        while ($row = $result->fetch_assoc()) {
            $name = $row["reqId"];
            echo "<option value='$name' class='option'> $name</option>";
        }
    }

    public function issueReport($reqid, $verfied, $comment)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "UPDATE labreport SET comment = '$comment', verified = '$verfied', issued  = '1' WHERE reqId='$reqid'";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getLabReports($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT reqId,verified,comment from labreport WHERE labreport.labName = '$uname'&& issued  = '1' ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();

    }

    public function getLabReportCount($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT COUNT(reqId) from labreport WHERE labreport.labName = '$uname'&& issued  = '1' ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();

    }

}