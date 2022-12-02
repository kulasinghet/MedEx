<?php

namespace app\core;

class ErrorLog
{
    public static function logError($message)
    {
        $dateTime = new \DateTime("now");
        $dateTime->setTimezone(new \DateTimeZone('Asia/Colombo'));
        $dateTime = $dateTime->format('Y/m/d H:i:s');
        error_log($dateTime." ". $message . "\n", 3, "../templates/error.log");
    }

}