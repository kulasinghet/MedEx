<?php

namespace app\models;

class DeliveryModel extends Model
{
    public string $username;
    public string $password;
    public string $name;
    public string $licenseId;
    public string $vehicleNo;
    public string $deliveryLocations;
    public string $maxLoad;
    public string $regDate;
    public string $refrigeration;

    //    public function loadData(array $getBody)
    //    {
    //        $this->username = $getBody['username'];
    //        $this->password = $getBody['password'];
    //        $this->name = $getBody['name'];
    //        $this->licenseId = $getBody['licenseId'];
    //        $this->vehicleNo = $getBody['vehicleNo'];
    //        $this->deliveryLocations = $getBody['deliveryLocations'];
    //        $this->maxLoad = $getBody['maxLoad'];
    //        $this->regDate = $getBody['regDate'];
    //        $this->refrigeration = $getBody['refrigeration'];
    //    }
    //
    //    public function validate()
    //    {
    //        if (empty($this->username)) {
    //            return false;
    //        } else if (empty($this->password)) {
    //            return false;
    //        } else if (empty($this->name)) {
    //            return false;
    //        } else if (empty($this->licenseId)) {
    //            return false;
    //        } else if (empty($this->vehicleNo)) {
    //            return false;
    //        } else if (empty($this->deliveryLocations)) {
    //            return false;
    //        } else if (empty($this->maxLoad)) {
    //            return false;
    //        } else if (empty($this->regDate)) {
    //            return false;
    //        } else if (empty($this->refrigeration)) {
    //            return false;
    //        } else {
    //            return true;
    //        }
    //    }

    public function registerDeliveryPartner()
    {

    }

    public function toString()
    {
        return "username: " . $this->username . " password: " . $this->password . " name: " . $this->name . " licenseId: " . $this->licenseId . " vehicleNo: " . $this->vehicleNo . " deliveryLocations: " . $this->deliveryLocations . " deliveryCondition: " . $this->deliveryCondition . " maxLoad: " . $this->maxLoad . " regDate: " . $this->regDate . " refrigeration: " . $this->refrigeration;
    }

}
