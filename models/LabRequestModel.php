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
    public $labUsername;

    // Add Supplier Lab Requests
    public function addRequest()
    {
        $db = (new Database())->getConnection();

        $recivedDate = new DateTime("now");
        $recivedDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $recivedDate = $recivedDate->format('Y/m/d');
        try {
            $sql = "INSERT INTO labreq (id, medId, SupName, recivedDate, labUsername,status) VALUES ('$this->id','$this->medId','$this->SupName','$recivedDate',Null,'0')";
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

    public function getSup_Medid($reqid)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT  medId,SupName from labreq WHERE  labreq.id = '$reqid' ;";
        $result = $db->query($sql);
        $db->close();
        return $result;

    }

    public function getNotAcceptedReq()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from labreq WHERE  labreq.status = '0'";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    public function getNotAcceptedReqFilter($searchTerm)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT labreq.id as id, labreq.medId as medId, labreq.SupName as SupName from labreq JOIN  medicine WHERE labreq.medId=medicine.id AND labreq.status = '0' AND medName like '%$searchTerm%'";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    public function getNotAcceptedReqCount()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT COUNT(id) from labreq WHERE  labreq.status = '0'";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }
    public function getAcceptedReq($labname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from labreq WHERE  labreq.status = '1' && labreq.labUsername='$labname'";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    public function getAcceptedReqFiltered($labname, $searchTerm)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT labreq.id AS id, labreq.medId AS medId, labreq.SupName AS SupName from labreq JOIN  medicine WHERE labreq.medId=medicine.id AND labreq.status = '1' AND labreq.labUsername='$labname' AND medName like '%$searchTerm%'";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    public function getAcceptedReqCount($labname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT COUNT(id) from labreq WHERE  labreq.status = '1' && labreq.labUsername='$labname'";
        $result = $db->query($sql);
        $db->close();
        return $result;
    }
    public function acceptReq($id, $labname)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "UPDATE  labreq SET labreq.status = '1' , labUsername='$labname' WHERE labreq.id='$id' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();
        } catch (\Exception $e) {
            return false;
        }

    }

}