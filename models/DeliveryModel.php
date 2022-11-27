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



    public function registerDeliveryPartner()
    {

    }

    public function toString()
    {
        return "username: " . $this->username . " password: " . $this->password . " name: " . $this->name . " licenseId: " . $this->licenseId . " vehicleNo: " . $this->vehicleNo . " deliveryLocations: " . $this->deliveryLocations . " deliveryCondition: " . $this->deliveryCondition . " maxLoad: " . $this->maxLoad . " regDate: " . $this->regDate . " refrigeration: " . $this->refrigeration;
    }

}
