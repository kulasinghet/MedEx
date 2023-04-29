<?php

namespace app\controllers\entity;

class Pharmacy
{

    public static function getPharmacyProfilePicture(mixed $username): string
    {
        return "uploads/profilePicture/" . $username . "_profilePicture.jpg";
    }
}
