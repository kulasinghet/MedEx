<?php

namespace app\controllers\entity;

class Pharmacy
{

    public static function getPharmacyProfilePicture(mixed $username): string
    {

//        check if the file exists
        if (file_exists("uploads/profilePicture/" . $username . "_profilePicture.jpg")) {
            return "/uploads/profilePicture/" . $username . "_profilePicture.jpg";
        } else {
            return "/res/avatar-empty.png";
        }
    }
}
