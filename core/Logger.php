<?php

namespace app\core;

class Logger
{
    public static function logError($message): void
    {
        $dateTime = new \DateTime("now");
        $dateTime->setTimezone(new \DateTimeZone('Asia/Colombo'));
        $dateTime = $dateTime->format('Y/m/d H:i:s');
        error_log($dateTime." ". $message . "\n", 3, "../logs/error.log");
    }

    public static function signInLog($message): void
    {
        $dateTime = new \DateTime("now");
        $dateTime->setTimezone(new \DateTimeZone('Asia/Colombo'));
        $dateTime = $dateTime->format('Y/m/d H:i:s');
        error_log($dateTime." ". $message . " signed in" . "\n", 3, "../logs/signin.log");
    }

    public function orderCreated($message): void
    {
        $dateTime = new \DateTime("now");
        $dateTime->setTimezone(new \DateTimeZone('Asia/Colombo'));
        $dateTime = $dateTime->format('Y/m/d H:i:s');
        error_log($dateTime." ". $message . " order created" . "\n", 3, "../logs/pharmacy-order.log");
    }

}